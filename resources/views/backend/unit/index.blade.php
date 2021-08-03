@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Units/Subjects List')
        </x-slot>
        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.unit.create')"
                    :text="__('Create Unit')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.units-table>
        </x-slot>
    </x-backend.card>
@endsection
