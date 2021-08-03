<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

use App\Domains\Qualification\Models\Qualification;

class QualificationsTable extends DataTableComponent
{
    // public function render()
    // {
    //     $qualifications = Qualification::all();
    //     return view('livewire.qualifications-table', compact('qualifications'));
    // }
    public function columns(): array
    {
        return [
            Column::make(__('Qualification_code'))
                    ->sortable(),
            Column::make(__('Title'))
                ->sortable(),                      
            Column::make(__('Actions')),
            // Column::make(__('Created On'), 'created_at')
            //     ->sortable()
            //     ->format(function($value) {
            //         return '<strong>'.$value.'</strong>';
            //     })
            //     ->asHtml(),   
        ];
    }
    public function query(): Builder
    {
        return Qualification::query()
        ->when($this->getFilter('search'), fn ($query, $term) => 
            $query->where('title', 'like', '%'.$term.'%')
                ->orWhere('qualification_code', 'like', '%'.$term.'%') );
    }
    public function rowView(): string
    {
        return 'backend.qualification.includes.row';
    }
}
