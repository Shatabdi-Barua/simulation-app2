<x-livewire-tables::bs4.table.cell>
    <a>{{ $row->type }}</a>
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    @include('backend.document_type.includes.actions', ['documentType'=>$row] )
</x-livewire-tables::bs4.table.cell>