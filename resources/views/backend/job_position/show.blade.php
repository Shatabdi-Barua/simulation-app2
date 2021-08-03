@inject('model', '\App\Domains\Unit\Models\Unit')

@extends('backend.layouts.app')

@section('title', __('View Job'))

@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('View Job')
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.job.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">      
            <table class="table table-hover"> 
                <tr>
                    <th>Job Title</th>
                    <td>{{ $job-> title }}</td>
                </tr>               
                <tr>
                    <th>Description</th>
                    <td>{{ $job-> description }}</td>
                </tr>  
            </table>
            </x-slot>
            <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Job Created'):</strong> @displayDate($job->created_at) ({{ $job->created_at->diffForHumans() }}),
                <strong>@lang('Job Updated'):</strong> @displayDate($job->updated_at) ({{ $job->updated_at->diffForHumans() }})
            </small>
        </x-slot>
        </x-backend.card>
@endsection
