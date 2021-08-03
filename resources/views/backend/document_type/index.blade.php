@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Document Types')
        </x-slot>
       
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.document_type.create')"
                    :text="__('Create Document Type')"
                />
            </x-slot>
     
        <x-slot name="body">
            <livewire:backend.document-types-table/>
        </x-slot>
    </x-backend.card>
@endsection
