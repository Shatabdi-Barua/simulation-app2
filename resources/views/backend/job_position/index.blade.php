@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Job Positions')
        </x-slot>
       
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.job.create')"
                    :text="__('Create Job')"
                />
            </x-slot>
     
        <x-slot name="body">
            <livewire:backend.job-positions-table/>
        </x-slot>
    </x-backend.card>
@endsection
