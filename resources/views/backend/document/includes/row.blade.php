<x-livewire-tables::bs4.table.cell>
    {{ $row->id }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    <a href="{{ route('admin.document.show', $row->id)}}">{{ $row->title }}</a>
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    <a class="btn btn-primary" href="{{ asset('storage/documents/'.$row->link) }}"><i class="far fa-eye"></i></a>
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    @include('backend.document.includes.actions', ['document'=>$row] )
</x-livewire-tables::bs4.table.cell>