@inject('model', '\App\Domains\Qualification\Models\Qualification')

@extends('backend.layouts.app')

@section('title', __('Create Qualification'))
@push('before-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <x-forms.post :action="route('admin.qualification.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Qualification')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.qualification.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label">@lang('Title')</label>

                        <div class="col-md-10">
                            <span class="badge" data-toggle="tooltip" title="must be less than 255 characters"><input type="text" name="title" class="form-control" placeholder="{{ __('Qualification Name') }}" value="{{ old('name') }}" maxlength="255" required /></span>
                        </div>
                    </div><!--form-group-->                                                                                                  
                </div>
                <div class="form-group row">
                    <label for="types" class="col-md-2 col-form-label">@lang('Unit')</label>
                    <div class="col-md-10">
                        <select class="form-control select2" name="units[]" id="units" multiple="multiple">
                            @foreach($units as $unit)
                                <option value="{{$unit->id  }}">{{ $unit->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>                
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Create Qualification')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
@push('before-scripts')
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <!-- <script>
        $('#units').select2();
    </script> -->
@endpush