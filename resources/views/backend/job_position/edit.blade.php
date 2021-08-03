@inject('model', '\App\Domains\JobPosition\Models\JobPosition')

@extends('backend.layouts.app')

@section('title', __('Edit Job Position'))
@section('content')
    <x-forms.patch :action="route('admin.job.update', $job)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Edit Job Position')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.job.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <!-- title  -->
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label">@lang('Job Title')</label>
                    <div class="col-md-10">
                        <input type="text" name="title" class="form-control" placeholder="{{ __('Job Title') }}" value="{{ old('name') ?? $job->title}}" maxlength="255" required/>
                    </div>
                </div>   
                <!-- description -->
                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label">@lang('Job Description')</label>
                    <div class="col-md-10">
                        <textarea name="description" rows="10" class="form-control" placeholder="{{ __('Job Description') }}" maxlength="255" required>{{ $job->description }}</textarea>
                    </div>
                </div>  
                               
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Update Job')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
