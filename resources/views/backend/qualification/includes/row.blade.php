<x-livewire-tables::bs4.table.cell>
    {{ $row->qualification_code }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    <a href="{{ route('admin.qualification.show', $row->id)}}">{{ $row->title }}</a>
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    @include('backend.qualification.includes.actions', ['qualification'=>$row] )
</x-livewire-tables::bs4.table.cell>