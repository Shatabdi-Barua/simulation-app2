<div>
    <div class="row mb-4">
        <div class="col form-inline">
            <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Search ID or Title...">
        </div>       
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th wire:click="sortingBy('title')" style="cursor: pointer; width:70%;">
                   Department Name
                   @include('partials._sort-icon',['field'=>'title'])
                </th>
                <th style="width:30%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $department)
            <tr>           
                <td>{{$department->title}}</td>                
                <td>@include('backend.department.includes.actions', ['department'=>$department] )</td>        
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
            Showing {{$departments->firstItem()}} to {{$departments->lastItem()}} out of {{$departments->total()}} departments
        </p>
        <p>
            {{$departments->links()}}
        </p>
    </div>
</div>
