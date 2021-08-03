<x-livewire-tables::bs4.table.cell>
    {{ $row->unit_code }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    <a href="{{ route('admin.unit.show', $row->id)}}">{{ $row->title }}</a>
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    @include('backend.unit.includes.actions', ['unit'=>$row] )
</x-livewire-tables::bs4.table.cell>