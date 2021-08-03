@inject('model', '\App\Domains\DocumentType\Models\DocumentType')

@extends('backend.layouts.app')

@section('title', __('Edit Document Type'))

@section('content')
<x-forms.patch :action="route('admin.document_type.update', $documentType)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Edit Document Type')
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.document_type.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">                
                <!-- type  -->                                  
                <div class="form-group row">
                    <label for="type" class="col-md-2 col-form-label">@lang('Type')</label>
                    <div class="col-md-10">
                        <input type="text" name="type" class="form-control" placeholder="{{ __('Document Type') }}" value="{{ old('name') ?? $documentType->type }}" maxlength="255" required />
                    </div>
                </div>                                                                                                                                 
            </x-slot>
            <x-slot name="footer">           
                <button class="btn btn-primary float-right" type="submit">@lang('Update')</button>
            </x-slot>
        </x-backend.card>
</x-forms.patch>
@endsection
