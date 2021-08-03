@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Qualifications List')
        </x-slot>
        @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.qualification.create-qualification') )
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.qualification.create')"
                    :text="__('Create Qualification')"
                />
            </x-slot>
        @endif
        <x-slot name="body">
            <livewire:backend.qualifications-table />
        </x-slot>
    </x-backend.card>
@endsection
