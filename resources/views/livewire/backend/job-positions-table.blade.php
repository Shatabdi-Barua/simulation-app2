<div>
    <div class="row mb-4">
        <div class="col form-inline">
            <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Search Job Title...">
        </div>      
    </div>
    
    <table class="table">
        <thead>
            <tr>       
                <th wire:click="sortingBy('title')" style="cursor: pointer; width:70%;">
                    Job Title
                    @include('partials._sort-icon',['field'=>'title'])
                </th>
                <th style="width:20%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jobs as $job)
            <tr>           
                <td><a href="{{ route('admin.job.show', $job->id)}}">{{$job->title}}</a></td>                    
                <td>@include('backend.job_position.includes.actions', ['job'=>$job] )</td>        
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
            Showing {{$jobs->firstItem()}} to {{$jobs->lastItem()}} out of {{$jobs->total()}} jobs
        </p>
        <p>
            {{$jobs->links()}}
        </p>
    </div>
</div>

