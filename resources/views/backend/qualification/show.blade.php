@inject('model', '\App\Domains\Qualification\Models\Qualification')

@extends('backend.layouts.app')

@section('title', __('Create Qualification'))
<style>
h2.legend{
    float: left;
    margin-left: 12px;
    margin-top: -10px;
    padding: 2% 35% 2% 30%;
    /* padding-top:5px;
    padding-left: 5px; */
    /* padding-right: 5px; */
    /* align: center; */
    font-family: Monospace;
    /* font-size: 1em; */
    /* font-weight: bold; */
    background: #fff;
    color: #696969!important;
    border-style: inset;
}
div.fieldset {
    margin: 15px;
    line-height: 2em;
    clear: both;
    padding: 2% 0% 0 0%;
}
</style>
@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('View Qualification')
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.qualification.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">
            <h2>{{ $qualification-> qualification_code }}. {{ $qualification-> title }} ( Release {{ $qualification->version }})</h2> 
            <hr>
            
            <div class="fieldset">
                <h2 class="legend">Status: {{ $qualification->status }}
                    <br>
                    Release Date: {{ $qualification->release_date }}
                    <br>                                        
                </h2>                 
                <br>             
            </div>
            <br>
            <div>          
            <!-- <h3>Associate Units: </h3> -->
           <br>
         
            <table class="table table-hover">    
            <a class="btn btn-primary" href="https://training.gov.au/Training/Details/{{ $qualification->qualification_code }}">Goto TGA</a>    
            <br><br>
            <h3>Associate Units: </h3>
            <a class="btn btn-success" style="float:right;" href="{{ route('admin.unit.create')}}"><i class="fas fa-plus"></i> Create New Unit</a>
                <br><br>
                <tr>
                    <th>Unit ID</th>
                    <th>Unit Title</th>
                    <th>Release Date</th>
                    <th>Released Version</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr> 
                  
                @foreach($qualificationUnits as $qualUnit)
                <tr>               
                    <td>{{ $qualUnit->unit_code }}</td>
                    <td>
                        <a href="{{ route('admin.unit.show', $qualUnit->id)}}">{{ $qualUnit->title }}</a>                        
                    </td>
                    <td>{{ $qualUnit->release_date }}</td>
                    <td>{{ $qualUnit->version }}</td>
                    <td>{{ $qualUnit->status }}</td>
                    <td>
                   
                    <x-utils.edit-button
                        :href="route('admin.unit.edit', $qualUnit->id)"
                        :text="__('Edit')" />                        
                    <x-utils.delete-button
                        :href="route('admin.unit.delete', $qualUnit->quID)"
                        :text="__('Remove')" />
                        
                    </td>
                </tr> 
                @endforeach 
                 
                 
                                
            </table>
            </div>
            </x-slot>
            <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Qualification Created'):</strong> @displayDate($qualification->created_at) ({{ $qualification->created_at->diffForHumans() }}),
                <strong>@lang('Last Updated'):</strong> @displayDate($qualification->updated_at) ({{ $qualification->updated_at->diffForHumans() }})
            </small>
        </x-slot>
        </x-backend.card>
@endsection
