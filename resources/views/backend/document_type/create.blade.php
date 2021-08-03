@inject('model', '\App\Domains\DocumentType\Models\DocumentType')

@extends('backend.layouts.app')

@section('title', __('Create Document Type'))
@push('before-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <x-forms.post :action="route('admin.document_type.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Document Type')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.document_type.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="type" class="col-md-2 col-form-label">@lang('Type')</label>
                        <div class="col-md-10">
                            <span data-toggle="tooltip" title="must be less than 255 characters"><input type="text" name="type" class="form-control" placeholder="{{ __('Document Type') }}" value="{{ old('name') }}" maxlength="255" required /></span>
                        </div>
                    </div><!--form-group-->                                                                                                  
                </div>
                               
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Create Type')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
