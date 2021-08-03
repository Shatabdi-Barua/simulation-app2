@inject('model', '\App\Domains\Document\Models\Document')

@extends('backend.layouts.app')

@section('title', __('Create Document'))

@section('content')
    <x-forms.post :action="route('admin.document.update', $document)" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Document')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.document.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                  <!-- document number  -->
                  <div class="form-group row">
                    <label for="document_number" class="col-md-2 col-form-label">@lang('Document Number')</label>
                    <div class="col-md-10">
                        <input type="text" name="document_number" class="form-control" placeholder="{{ __('Document Number') }}" value="{{ old('name') ?? $document->document_number }}" maxlength="255" required/>
                    </div>
                </div> 
                 <!-- title  -->
                 <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label">@lang('Title')</label>
                    <div class="col-md-10">
                        <span data-toggle="tooltip" title="must be less than 255 characters"><input type="text" name="title" class="form-control" placeholder="{{ __('Document Name') }}" value="{{ old('name') ?? $document->title }}" maxlength="255" required /></span>
                    </div>
                </div>   
                <!-- type  -->
                <div class="form-group row">
                    <label for="type" class="col-md-2 col-form-label">@lang('Type')</label>
                    <div class="col-md-10">
                    <select class="form-control" name="type" id="type">                                             
                        @foreach($documentTypes as $documentType)
                        <option value="{{ $documentType->id }}"
                            @if($documentType->type == $document->type)                            
                                selected
                            @endif
                            >{{ $documentType->type }}
                        </option>                            
                        @endforeach
                        </select>
                    </select>
                    </div>
                </div>
                <!-- Description  -->
                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label">@lang('Description')</label>
                    <div class="col-md-10">
                        <textarea type="text" name="description" class="form-control" placeholder="{{ __('Description') }}" maxlength="255" required>{{ old('name') ?? $document->description }}</textarea>
                    </div>
                </div>                                                                                                    
                <!-- Link  -->
                <div class="form-group row">
                    <label for="file" class="col-md-2 col-form-label">@lang('Link')</label>
                    <div class="col-md-10">                     
                        <!-- <iframe src="/storage/documents/{{ $document->link }}" frameborder="0"></iframe> -->
                        <input type="file" name="file" required/>
                    </div>
                </div>
                               
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Update')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
