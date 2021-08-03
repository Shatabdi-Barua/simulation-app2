<div>
    <!-- {{ $documents }} -->
    <div class="row mb-4">
        <div class="col form-inline">
            <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Search Number or Title...">
        </div>
        <!-- <div class="col form-inline">
            Per Page: &nbsp;
            <select wire:model="perPage" class="form-control">
                <option>2</option>
                <option>5</option>
                <option>10</option>
                <option>15</option>
                <option>25</option>
            </select>
        </div> -->       
    </div>
    
    <table class="table">
        <thead>
            <tr>
                
                <th wire:click="sortingBy('document_number')" style="cursor: pointer; width:20%;">
                    Document No.
                    @include('partials._sort-icon',['field'=>'document_number'])
                </th>
                <th wire:click="sortingBy('title')" style="cursor: pointer; width:30%;">
                    Title
                    @include('partials._sort-icon',['field'=>'title'])
                </th>
                <th wire:click="sortingBy('type_id')" style="cursor: pointer; width:20%;">
                    Types
                    @include('partials._sort-icon',['field'=>'type_id'])
                </th>
                <th style="width:10%;">Files</th>
                <th style="width:20%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($documents as $document)
            <tr>           
                <!-- <td>{{$document->id}}</td> -->
                <td>{{$document->document_number}}</td>
                <td><a href="{{ route('admin.document.show', $document->id)}}">{{$document->title}}</a></td>    
                <td>
                    @foreach($documentTypes as $documentType)
                        @if( $document->type_id == $documentType->id )
                            {{ $documentType->type }}
                        @endif
                    @endforeach
                </td>
                <td><a class="btn btn-primary" href="{{ asset('storage/documents/'.$document->link) }}"><i class="far fa-eye"></i></a></td>
                <td>@include('backend.document.includes.actions', ['document'=>$document] )</td>        
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
            Showing {{$documents->firstItem()}} to {{$documents->lastItem()}} out of {{$documents->total()}} documents
        </p>
        <p>
            {{$documents->links()}}
        </p>
    </div>
</div>
