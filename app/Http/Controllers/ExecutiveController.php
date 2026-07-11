<?php

namespace App\Http\Controllers;

use App\Services\DigitailService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ExecutiveController extends Controller
{
    /**
     * Fixed status tokens (good/warning/serious/critical) — never themed to
     * the brand palette, so a status color never doubles as a brand accent.
     */
    private const STATUS_GOOD = '#0ca30c';
    private const STATUS_WARNING = '#fab219';
    private const STATUS_SERIOUS = '#ec835a';
    private const STATUS_CRITICAL = '#d03b3b';

    public function __construct(private DigitailService $digitailService)
    {
    }

    private function statusColor(string $label): string
    {
        $label = strtolower($label);

        return match (true) {
            str_contains($label, 'cancel'), str_contains($label, 'belum') => self::STATUS_CRITICAL,
            str_contains($label, 'no_show'), str_contains($label, 'no-show') => self::STATUS_SERIOUS,
            str_contains($label, 'reschedul'), str_contains($label, 'pending'), str_contains($label, 'sebagian') => self::STATUS_WARNING,
            default => self::STATUS_GOOD,
        };
    }

    public function showLogin()
    {
        return view('executive.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->onlyInput('email');
        }

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
        }

        if (!Auth::user()->isExecutive()) {
            Auth::logout();

            return back()->withErrors(['email' => 'Akun ini tidak memiliki akses ke halaman executive.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('executive.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('executive.login');
    }

    public function dashboard(Request $request)
    {
        $startDate = $request->query('start_date') ?: now()->startOfMonth()->toDateString();
        $endDate = $request->query('end_date') ?: now()->toDateString();

        $sales = collect($this->digitailService->getSales(1, 250, $startDate, $endDate)['data'] ?? []);
        $appointments = collect($this->digitailService->getAppointments(1, 250, $startDate, $endDate)['data'] ?? []);
        $reminders = collect($this->digitailService->getReminderProtocolUsages(1, 250, $startDate, $endDate)['data'] ?? []);
        $petParentsResponse = $this->digitailService->getPetParents(1, 250);
        $petParents = collect($petParentsResponse['data'] ?? [])->filter(
            fn ($p) => Carbon::parse($p['created_at'])->between(
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            )
        );
        $labOrdersResponse = $this->digitailService->getLabOrders();
        $labOrders = collect($labOrdersResponse['data'] ?? [])->filter(
            fn ($o) => Carbon::parse($o['created_at'])->between(
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            )
        );
        $petsReport = $this->digitailService->getPetsReportAggregated();
        $vets = collect($this->digitailService->getVets())->keyBy('id');
        $species = $this->digitailService->getSpecies();

        return view('executive.dashboard', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'financial' => $this->financialSummary($sales),
            'revenueTrend' => $this->revenueTrend($sales),
            'topServices' => $this->topServices($sales),
            'revenueByVet' => $this->revenueByVet($sales, $vets),
            'paymentStatus' => $this->paymentStatusBreakdown($sales),
            'appointmentsSummary' => $this->appointmentsSummary($appointments),
            'appointmentsStatus' => $this->appointmentsStatusBreakdown($appointments),
            'appointmentsPerDay' => $this->appointmentsPerDay($appointments),
            'latestAppointments' => $this->latestAppointments($appointments),
            'petsSummary' => $this->petsSummary($petsReport),
            'petsSpecies' => $this->petsSpeciesChart($petsReport),
            'labOrdersSummary' => $this->labOrdersSummary($labOrders),
            'reminderCompliance' => $this->reminderCompliance($reminders),
            'reminderBySpecies' => $this->reminderBySpecies($reminders, $species),
            'petParentsGrowth' => $this->petParentsGrowth($petParents, $startDate, $endDate),
        ]);
    }

    private function financialSummary(Collection $sales): array
    {
        $total = $sales->sum(fn ($s) => (float) $s['total']);
        $outstanding = $sales->sum(fn ($s) => (float) $s['amount_due']);

        return [
            'total' => $total,
            'outstanding' => $outstanding,
            'avg' => $sales->count() > 0 ? $total / $sales->count() : 0,
            'count' => $sales->count(),
        ];
    }

    private function revenueTrend(Collection $sales): array
    {
        $grouped = $sales
            ->groupBy(fn ($s) => Carbon::parse($s['closed_at'] ?? $s['created_at'])->format('Y-m-d'))
            ->map(fn ($group) => $group->sum(fn ($s) => (float) $s['total']))
            ->sortKeys();

        return [
            'labels' => $grouped->keys()->map(fn ($d) => Carbon::parse($d)->format('d M'))->values()->all(),
            'data' => $grouped->values()->all(),
        ];
    }

    private function topServices(Collection $sales): array
    {
        $grouped = $sales
            ->flatMap(fn ($s) => $s['treatments'] ?? [])
            ->groupBy(fn ($t) => $t['product_name'] ?? $t['label'] ?? 'Unknown')
            ->map(fn ($group) => $group->sum(fn ($t) => (float) ($t['total_price'] ?? 0)))
            ->sortDesc()
            ->take(10);

        return [
            'labels' => $grouped->keys()->values()->all(),
            'data' => $grouped->values()->all(),
        ];
    }

    private function revenueByVet(Collection $sales, Collection $vets): array
    {
        $grouped = $sales
            ->groupBy('vet_id')
            ->map(fn ($group) => $group->sum(fn ($s) => (float) $s['total']))
            ->sortDesc()
            ->take(10);

        return [
            'labels' => $grouped->keys()->map(fn ($id) => $vets->get($id)['full_name'] ?? "Vet #{$id}")->values()->all(),
            'data' => $grouped->values()->all(),
        ];
    }

    private function paymentStatusBreakdown(Collection $sales): array
    {
        $grouped = $sales->groupBy(function ($s) {
            $due = (float) $s['amount_due'];
            $paid = (float) $s['amount_paid'];

            if ($due <= 0 && $paid > 0) {
                return 'Lunas';
            }

            return $paid > 0 ? 'Sebagian' : 'Belum Dibayar';
        })->map(fn ($group) => $group->count());

        return [
            'labels' => $grouped->keys()->values()->all(),
            'data' => $grouped->values()->all(),
            'colors' => $grouped->keys()->map(fn ($label) => $this->statusColor($label))->values()->all(),
        ];
    }

    private function appointmentsSummary(Collection $appointments): array
    {
        $total = $appointments->count();
        $groupedByDate = $appointments->groupBy(fn ($a) => Carbon::parse($a['datetime_start_utc'])->format('Y-m-d'));
        $vaccinations = $appointments->filter(function ($a) {
            $cat = strtolower($a['visit_type']['category_label'] ?? $a['service']['label'] ?? '');

            return str_contains($cat, 'vaccin');
        })->count();

        return [
            'total' => $total,
            'avgPerDay' => $groupedByDate->count() > 0 ? round($total / $groupedByDate->count(), 1) : 0,
            'vaccinations' => $vaccinations,
            'vaccinationRate' => $total > 0 ? round(($vaccinations / $total) * 100, 1) : 0,
        ];
    }

    private function appointmentsStatusBreakdown(Collection $appointments): array
    {
        $grouped = $appointments
            ->groupBy(fn ($a) => $a['status'] ?? 'unknown')
            ->map(fn ($group) => $group->count())
            ->sortDesc();

        return [
            'labels' => $grouped->keys()->map(fn ($s) => Str::headline($s))->values()->all(),
            'data' => $grouped->values()->all(),
            'colors' => $grouped->keys()->map(fn ($label) => $this->statusColor($label))->values()->all(),
        ];
    }

    private function appointmentsPerDay(Collection $appointments): array
    {
        $grouped = $appointments
            ->groupBy(fn ($a) => Carbon::parse($a['datetime_start_utc'])->format('Y-m-d'))
            ->map(fn ($group) => $group->count())
            ->sortKeys();

        return [
            'labels' => $grouped->keys()->map(fn ($d) => Carbon::parse($d)->format('d M'))->values()->all(),
            'data' => $grouped->values()->all(),
        ];
    }

    private function latestAppointments(Collection $appointments): array
    {
        return $appointments
            ->sortByDesc('datetime_start_utc')
            ->take(5)
            ->map(fn ($a) => [
                'date' => Carbon::parse($a['datetime_start_utc'])->format('d M Y H:i'),
                'pet' => $a['pet']['nickname'] ?? '-',
                'service' => $a['service']['label'] ?? '-',
                'vet' => trim(($a['vet']['first_name'] ?? '') . ' ' . ($a['vet']['last_name'] ?? '')) ?: '-',
                'status' => Str::headline($a['status'] ?? 'unknown'),
                'statusColor' => $this->statusColor($a['status'] ?? 'unknown'),
            ])
            ->values()
            ->all();
    }

    private function petsSummary(?array $petsReport): array
    {
        $stats = $petsReport['data']['statistics'] ?? null;

        if (!$stats) {
            return ['total' => 0, 'topSpecies' => '-', 'topBreed' => '-', 'topAge' => '-'];
        }

        $species = collect($stats['species']['breakdown'] ?? []);
        $breeds = collect($stats['breeds']['breakdown'] ?? []);
        $age = collect($stats['age']['breakdown'] ?? []);

        return [
            'total' => $species->sum('amount'),
            'topSpecies' => $species->sortByDesc('amount')->first()['label'] ?? '-',
            'topBreed' => $breeds->sortByDesc('amount')->first()['label'] ?? '-',
            'topAge' => $age->sortByDesc('amount')->first()['label'] ?? '-',
        ];
    }

    private function petsSpeciesChart(?array $petsReport): array
    {
        $species = collect($petsReport['data']['statistics']['species']['breakdown'] ?? [])->sortByDesc('amount');

        return [
            'labels' => $species->pluck('label')->values()->all(),
            'data' => $species->pluck('amount')->values()->all(),
        ];
    }

    private function labOrdersSummary(Collection $labOrders): array
    {
        return [
            'total' => $labOrders->count(),
            'pending' => $labOrders->where('status', 'pending')->count(),
            'completed' => $labOrders->where('status', 'completed')->count(),
            'topLab' => $labOrders->countBy('lab.name')->sortDesc()->keys()->first() ?? '-',
        ];
    }

    private function reminderCompliance(Collection $reminders): array
    {
        $today = Carbon::today();
        $pending = $reminders->whereNull('administration_date');
        $overdue = $pending->filter(fn ($r) => Carbon::parse($r['due_date'])->lt($today));
        $administered = $reminders->whereNotNull('administration_date')->count();

        return [
            'total' => $reminders->count(),
            'overdue' => $overdue->count(),
            'pending' => $pending->count() - $overdue->count(),
            'administered' => $administered,
            'complianceRate' => $reminders->count() > 0 ? round(($administered / $reminders->count()) * 100, 1) : 0,
        ];
    }

    private function reminderBySpecies(Collection $reminders, array $species): array
    {
        $grouped = $reminders
            ->groupBy(fn ($r) => $species[$r['pet']['species_id'] ?? null] ?? 'Unknown')
            ->map(fn ($group) => $group->count())
            ->sortDesc();

        return [
            'labels' => $grouped->keys()->values()->all(),
            'data' => $grouped->values()->all(),
        ];
    }

    private function petParentsGrowth(Collection $petParents, string $startDate, string $endDate): array
    {
        $grouped = $petParents
            ->groupBy(fn ($p) => Carbon::parse($p['created_at'])->format('Y-m-d'))
            ->map(fn ($group) => $group->count())
            ->sortKeys();

        return [
            'labels' => $grouped->keys()->map(fn ($d) => Carbon::parse($d)->format('d M'))->values()->all(),
            'data' => $grouped->values()->all(),
            'total' => $petParents->count(),
        ];
    }
}
