@inject('model', '\App\Domains\Department\Models\Department')

@extends('backend.layouts.app')

@section('title', __('Create Department'))
@section('content')
    <x-forms.post :action="route('admin.department.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Department')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.department.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label">@lang('Department Name')</label>
                        <div class="col-md-10">
                            <input type="text" name="title" class="form-control" placeholder="{{ __('Department Name') }}" value="{{ old('name') }}" maxlength="255" required/>
                        </div>
                    </div><!--form-group-->                                                                                                  
                </div>
                               
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Create Department')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
