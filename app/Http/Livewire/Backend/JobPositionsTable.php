<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Domains\JobPosition\Models\JobPosition;
use Livewire\Component;

class JobPositionsTable extends DataTableComponent
{
    public $sortingBy = 'title';

    public $sortDirection = 'asc';
    public $search = '';

    public function render()
    {
        $jobs = JobPosition::query()
                    ->search($this->search)
                    ->orderBy($this->sortingBy, $this->sortDirection)
                    ->paginate(2);
        // print_r($documents);
        // return view('livewire.backend.documents-table',[
        //     'documents'=> $documents
        // ]);
        // $documents= Document::all();
        return view('livewire.backend.job-positions-table', compact('jobs'));
    }
    /* *************** sort *********** */ 
    public function sortingBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
        return $this->sortingBy = $field;
    }

    public function columns(): array
    {
        return [
            Column::make(__('Title.'))
                    ->sortable(),                                    
            Column::make(__('Actions')),
        ];
    }
     
    public function query(): Builder
    {
        return Document::query()
        ->when($this->getFilter('search'), fn ($query, $term) => $query->where('title', 'like', '%'.$term.'%'));        
    }
   
}
