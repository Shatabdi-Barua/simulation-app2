<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use  App\Domains\Unit\Models\Unit;
use Livewire\Component;

class UnitsTable extends DataTableComponent
{
    // public function render()
    // {
    //     $units = Unit::all();
    //     return view('livewire.units-table', compact('units'));
    // }
    public function columns(): array
    {
        return [
            Column::make(__('Unit Code'))
                ->sortable(),     
            Column::make(__('Title'))
                ->sortable(),                      
            Column::make(__('Actions')),             
        ];
    }
    public function query(): Builder
    {
        return Unit::query()
        ->when($this->getFilter('search'), fn ($query, $term) 
            => $query->where('title', 'like', '%'.$term.'%')
                    ->orWhere('unit_code', 'like','%'.$term.'%'));
    }
    public function rowView(): string
    {
        return 'backend.unit.includes.row';
    }
}
