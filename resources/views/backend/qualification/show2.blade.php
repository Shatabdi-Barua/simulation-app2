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
            <table class="table table-hover">                
                <tr>
                    <th>Title</th>
                    <td>{{ $qualification-> title }}</td>
                </tr> 
                <tr>
                    <th>Units</th>
                    <td>
                        @foreach($qualification->units as $unit)
                            {{ $unit->title }}
                            <br>
                        @endforeach
                    </td>
                </tr>                      
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
