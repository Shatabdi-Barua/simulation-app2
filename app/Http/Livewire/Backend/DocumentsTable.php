<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Domains\Document\Models\Document;
use App\Domains\DocumentType\Models\DocumentType;
use Livewire\Component;
// use Vendor\Livewire\Livewire\Src\WithPagination;
// use Livewire\WithPagination;
class DocumentsTable extends DataTableComponent
{
    // use WithPerPagePagination;

    public $sortingBy = 'id';

    public $sortDirection = 'asc';
    public $search = '';
    // public $page  = 2;
    // public int $perPage = 1;
    public function render()
    {
        $documents = Document::query()
                    ->search($this->search)
                    ->orderBy($this->sortingBy, $this->sortDirection)
                    ->paginate(2);
        // print_r($documents);
        $documentTypes = DocumentType::all();
        // return view('livewire.backend.documents-table',[
        //     'documents'=> $documents
        // ]);
        // $documents= Document::all();
        return view('livewire.backend.documents-table', compact('documents', 'documentTypes'));
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
            Column::make(__('No.')),
            Column::make(__('Name'))
                ->sortable(),
            Column::make(__('Files')),                                       
            Column::make(__('Actions')),
        ];
    }
     
    public function query(): Builder
    {
        return Document::query()
        ->when($this->getFilter('search'), fn ($query, $term) => $query->where('title', 'like', '%'.$term.'%'));        
    }
    public function rowView(): string
    {       
        return 'backend.document.includes.row';
    }
}
