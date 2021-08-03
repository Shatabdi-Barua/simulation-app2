@inject('model', '\App\Domains\Unit\Models\Unit')

@extends('backend.layouts.app')

@section('title', __('Create Unit'))

@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('View Unit')
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.unit.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">      
            <table class="table table-hover"> 
                <tr>
                    <th>Code</th>
                    <td>{{ $unit-> unit_code }}</td>
                </tr>               
                <tr>
                    <th>Title</th>
                    <td>{{ $unit-> title }}</td>
                </tr>  
                <tr>
                    <th>Release Date</th>
                    <td>{{ $unit-> release_date }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $unit-> status }}</td>
                </tr>  
                <tr>
                    <th>Version</th>
                    <td>{{ $unit-> version }}</td>
                </tr>
                <tr>
                    <th>Qualifications</th>
                    <td>
                        @foreach($unit->qualifications as $qualificationUnit)
                            <a href="{{ route('admin.qualification.show', $qualificationUnit->id) }}">{{ $qualificationUnit->title }}</a>
                            <br>
                        @endforeach                        
                    </td>
                </tr>
                <tr>
                    <th>TGA Link</th>
                    <td>
                        <a class="btn btn-outline-primary" href="https://training.gov.au/Training/Details/{{ $unit-> unit_code }}">Click Here</a>
                    </td>
                </tr>
            </table>
            </x-slot>
            <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Unit Created'):</strong> @displayDate($unit->created_at) ({{ $unit->created_at->diffForHumans() }}),
                <strong>@lang('Last Updated'):</strong> @displayDate($unit->updated_at) ({{ $unit->updated_at->diffForHumans() }})
            </small>
        </x-slot>
        </x-backend.card>
@endsection
