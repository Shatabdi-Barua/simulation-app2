@inject('model', '\App\Domains\Unit\Models\Unit')

@extends('backend.layouts.app')

@section('title', __('Unit'))

@section('content')
<x-forms.post :action="route('admin.unit.update', $unit)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Edit Unit')
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.unit.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">                                  
                <!-- code -->
                <div class="form-group row">
                        <label for="unit_code" class="col-md-2 col-form-label">@lang('Unit Code')</label>
                        <div class="col-md-10">
                            <input style="width:100%" type="text" name="unit_code" class="form-control" placeholder="{{ __('Unit Code') }}" value="{{ old('unit_code') ?? $unit->unit_code }}" maxlength="255" required />
                        </div>
                </div>
                <!-- title  -->
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label">@lang('Title')</label>
                    <div class="col-md-10">
                    <span class="badge" data-toggle="tooltip" title="must be less than 255 characters"><input type="text" name="title" class="form-control" placeholder="{{ __('Unit Name') }}" value="{{ old('name') ?? $unit->title }}" maxlength="255" required /></span>
                    </div>
                </div>                                                                                                  
                <!-- released date  -->
                <div class="form-group row">
                    <label for="release_date" class="col-md-2 col-form-label">@lang('Release Date')</label>
                    <div class="col-md-10">
                        <input style="width:100%" type="date" name="release_date" class="form-control" placeholder="{{ __('Release Date') }}" value="{{ old('release_date') ?? $unit->release_date }}" maxlength="255" required />
                    </div>
                </div>
                <!-- status  -->
                <div class="form-group row">
                    <label for="status" class="col-md-2 col-form-label">@lang('Status')</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control" required>                            
                            <option value="release" {{ $unit->status === 'release' ? 'selected' : '' }}>@lang('Release')</option>
                            <option value="unrelease" {{ $unit->status === 'unrelease' ? 'selected' : '' }}>@lang('Unrelease')</option>
                        </select>                            
                    </div>
                </div>
                <!-- version    -->
                <div class="form-group row">
                    <label for="version" class="col-md-2 col-form-label">@lang('Version')</label>
                        <div class="col-md-10">
                            <input style="width:100%" type="number" name="version" class="form-control" placeholder="{{ __('Version') }}" value="{{ old('version') ?? $unit->version }}" maxlength="255" required />
                        </div>
                </div>  
                <!-- qualifications  -->
                <div class="form-group row">
                    <label for="qualifications" class="col-md-2 col-form-label">@lang('Unit')</label>
                    <div class="col-md-10">
                        <select class="form-control" name="qualifications[]" id="qualifications" multiple>
                            @foreach($qualifications as $qualification)
                                <option value="{{ $qualification->id }}"
                                    @foreach($unit->qualifications as $qualificationUnit)
                                        @if($qualificationUnit->id == $qualification->id)
                                            selected
                                        @endif
                                    @endforeach    
                                   >{{ $qualification->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  
            </x-slot>
            <x-slot name="footer">           
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Unit')</button>
        </x-slot>
        </x-backend.card>
</x-forms.post>
@endsection
