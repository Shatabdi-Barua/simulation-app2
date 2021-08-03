@inject('model', '\App\Domains\Qualification\Models\Qualification')

@extends('backend.layouts.app')

@section('title', __('Create Qualification'))

@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('View Qualification')
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.qualification.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">
            <h1>{{ $qualification-> qualification_code }}. {{ $qualification-> title }} ( Release {{ $qualification->version }})</h1> 
            <h2>Status: {{ $qualification->status }}
                <br>
                Release Date: {{ $qualification->release_date }}
                <br>
            </h2>
            <h2>Associate Units: </h2>
           
            <table class="table table-hover">        
             
                <tr>
                    <th>Unit ID</th>
                    <th>Unit Title</th>
                    <th>Release Date</th>
                    <th>Released Version</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr> 
                  
                @foreach($qualificationUnits as $qualUnit)
                <tr>               
                    <td>{{ $qualUnit->unit_code }}</td>
                    <td>
                        <a href="{{ route('admin.unit.show', $qualUnit->id)}}">{{ $qualUnit->title }}</a>                        
                    </td>
                    <td>{{ $qualUnit->release_date }}</td>
                    <td>{{ $qualUnit->version }}</td>
                    <td>{{ $qualUnit->status }}</td>
                    <td>
                   
                    <x-utils.edit-button
                        :href="route('admin.unit.edit', $qualUnit->id)"
                        :text="__('Edit')" />                        
                    <x-utils.delete-button
                        :href="route('admin.unit.delete', $qualUnit->quID)"
                        :text="__('Remove')" />
                        
                    </td>
                </tr> 
                @endforeach 
                 
                 
                                
            </table>
            </x-slot>
            <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Qualification Created'):</strong> @displayDate($qualification->created_at) ({{ $qualification->created_at->diffForHumans() }}),
                <strong>@lang('Last Updated'):</strong> @displayDate($qualification->updated_at) ({{ $qualification->updated_at->diffForHumans() }})
            </small>
        </x-slot>
        </x-backend.card>
@endsection
