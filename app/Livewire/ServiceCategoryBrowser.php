<?php

namespace App\Livewire;

use App\Models\ServiceCategory;
use App\Support\CategoryTheme;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceCategoryBrowser extends Component
{
    use WithPagination;

    public ServiceCategory $category;

    #[Url(as: 'q', history: true)]
    public string $search = '';

    private const PER_PAGE = 6;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function clearSearch(): void
    {
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {
        $locale = app()->getLocale();
        $search = trim($this->search);

        $query = $this->category->clinicServices()->active()->ordered()->with('serviceImages');

        if ($search !== '') {
            $query->where(function ($q) use ($search, $locale) {
                $q->where("name->{$locale}", 'ilike', "%{$search}%")
                    ->orWhere("excerpt->{$locale}", 'ilike', "%{$search}%");
            });
        }

        $services = $query->paginate(self::PER_PAGE);

        return view('livewire.service-category-browser', [
            'services' => $services,
            'theme' => CategoryTheme::for($this->category->slug),
            'hasSearch' => $search !== '',
        ]);
    }
}
