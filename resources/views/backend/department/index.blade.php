@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Departments')
        </x-slot>
       
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.department.create')"
                    :text="__('Create Department')"
                />
            </x-slot>
     
        <x-slot name="body">
            <livewire:backend.departments-table/>
        </x-slot>
    </x-backend.card>
@endsection
