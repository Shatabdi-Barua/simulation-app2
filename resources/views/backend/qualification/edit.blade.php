@if (
        $logged_in_user->hasAllAccess() ||
        (            
            $logged_in_user->can('admin.qualification.edit-qualification')
        )
    )
@inject('model', '\App\Domains\Qualification\Models\Qualification')

@extends('backend.layouts.app')

@section('title', __('Create Qualification'))

@section('content')
<x-forms.post :action="route('admin.qualification.update', $qualification)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Edit Qualification')
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.qualification.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">
                 <!-- code  -->
                 <div class="form-group row">
                    <label for="qualification_code" class="col-md-2 col-form-label">@lang('Code')</label>
                    <div class="col-md-10">
                        <input type="text" name="qualification_code" class="form-control" placeholder="{{ __('Qualification Code') }}" value="{{ old('qualification_code') ?? $qualification->qualification_code }}" maxlength="255" required/>
                    </div>
                </div>
                <!-- title  -->                                  
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label">@lang('Title')</label>
                    <div class="col-md-10">
                        <input type="text" name="title" class="form-control" placeholder="{{ __('Qualification Name') }}" value="{{ old('name') ?? $qualification->title }}" maxlength="255" required />
                    </div>
                </div>
                <!-- released date  -->
                <div class="form-group row">
                    <label for="release_date" class="col-md-2 col-form-label">@lang('Release Date')</label>
                    <div class="col-md-10">
                        <input style="width:100%" type="date" name="release_date" class="form-control" placeholder="{{ __('Release Date') }}" value="{{ old('release_date') ?? $qualification->release_date }}" maxlength="255" required />
                    </div>
                </div>
                <!-- status  -->
                <div class="form-group row">
                    <label for="status" class="col-md-2 col-form-label">@lang('Status')</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control" required>
                            <option value="release">@lang('Release')</option>
                            <option value="unrelease">@lang('Unrelease')</option>
                        </select>                            
                    </div>
                </div>
                <!-- version    -->
                <div class="form-group row">
                    <label for="version" class="col-md-2 col-form-label">@lang('Version')</label>
                    <div class="col-md-10">
                        <input style="width:100%" type="number" name="version" class="form-control" placeholder="{{ __('Version') }}" value="{{ old('version') ?? $qualification->version }}" maxlength="255" required />
                    </div>
                </div>
                <!-- unit   -->
                <div class="form-group row">
                    <label for="units" class="col-md-2 col-form-label">@lang('Units')</label>
                    <div class="col-md-10">
                        <select class="form-control" name="units[]" id="units" multiple>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}"
                                    @foreach($qualification->units as $qualUnit)
                                        @if($qualUnit->id == $unit->id)
                                            selected
                                        @endif
                                    @endforeach    
                                   >{{ $unit->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>                                                                                                                  
            </x-slot>
            <x-slot name="footer">           
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Qualification')</button>
        </x-slot>
        </x-backend.card>
</x-forms.post>
@endsection
@endif