<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

use  App\Domains\DocumentType\Models\DocumentType;

class DocumentTypesTable extends DataTableComponent
{
    public $sortingBy = 'type';

    public $sortDirection = 'asc';

    public $search='';
    public function render()
    {
        $documentTypes = DocumentType::query()
                        ->search($this->search)
                        ->orderBy($this->sortingBy, $this->sortDirection)
                        ->paginate(2);
        return view('livewire.backend.document-types-table',[
            'documentTypes' => $documentTypes
        ]);
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
            Column::make(__('Type'))
                ->sortable(),                      
            Column::make(__('Actions')),
        ];
    }
    public function query(): Builder
    {
        return DocumentType::query()
        ->when($this->getFilter('search'), fn ($query, $term) => $query->where('type', 'like', '%'.$term.'%'));        
    }
    public function rowView(): string
    {
        return 'backend.document_type.includes.row';
    }
}

