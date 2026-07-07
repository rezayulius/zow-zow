<?php

namespace App\Http\Controllers;

use App\Models\ClinicFacility;
use Illuminate\View\View;

class ClinicFacilityController extends Controller
{
    public function index(): View
    {
        $facilities = ClinicFacility::active()->ordered()->with('images')->get();

        return view('facilities.index', compact('facilities'));
    }

    public function show(ClinicFacility $facility): View
    {
        abort_unless($facility->is_active, 404);

        $facility->load(['images', 'equipment', 'faqs']);

        return view('facilities.show', compact('facility'));
    }
}
