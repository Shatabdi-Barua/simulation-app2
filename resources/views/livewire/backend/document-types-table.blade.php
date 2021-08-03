<div>
    <div class="row mb-4">
        <div class="col form-inline">
            <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Search Type...">
        </div>       
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th wire:click="sortingBy('type')" style="cursor: pointer; width:70%;">
                   Type
                    @include('partials._sort-icon',['field'=>'type'])
                </th>
                <th style="width:30%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($documentTypes as $documentType)
            <tr>           
                <td>{{$documentType->type}}</td>                
                <td>@include('backend.document_type.includes.actions', ['documentType'=>$documentType] )</td>        
            </tr>
            @empty
            <tr>   
                <td>            
                No data found
                </td>
            </tr>
            @endforelse    
        </tbody>
    </table>
    <div>
        <p>
            Showing {{$documentTypes->firstItem()}} to {{$documentTypes->lastItem()}} out of {{$documentTypes->total()}} documents
        </p>
        <p>
            {{$documentTypes->links()}}
        </p>
    </div>
</div>
