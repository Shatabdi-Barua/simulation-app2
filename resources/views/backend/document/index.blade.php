@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Documents')
        </x-slot>
       
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.document.create')"
                    :text="__('Create Document')"
                />
            </x-slot>
     
        <x-slot name="body">  
            <livewire:backend.documents-table>                
        </x-slot>
    </x-backend.card>
@endsection
