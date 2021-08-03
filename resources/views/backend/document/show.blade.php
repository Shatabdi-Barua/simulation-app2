@inject('model', '\App\Domains\Document\Models\Document')

@extends('backend.layouts.app')

@section('title', __('View Document'))

@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('View Document')
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.document.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">      
            <table class="table table-hover"> 
                <tr>
                    <th>Document Number</th>
                    <td>{{ $document->document_number }}</td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{ $document->title }}</td>
                </tr>               
                <tr>
                    <th>Type</th>
                    <td>{{ $documentType->type}}</td>
                </tr>  
                <tr>
                    <th>Description</th>
                    <td>{{ $document->description }}</td>
                </tr>
                <tr>
                    <th>Link</th>
                    <td>
                        @if($document->link != '0')                        
                            <a href="{{route('admin.document.download',$document->link )}}">{{ $document-> link }}</a>                            
                        @endif
                    </td>
                </tr>                  
            </table>
            </x-slot>
            <x-slot name="footer">
                <small class="float-right text-muted">
                    <strong>@lang('Document Created'):</strong> @displayDate($document->created_at) ({{ $document->created_at->diffForHumans() }}),
                    <strong>@lang('Last Updated'):</strong> @displayDate($document->updated_at) ({{ $document->updated_at->diffForHumans() }})
                </small>
            </x-slot>
        </x-backend.card>
@endsection
