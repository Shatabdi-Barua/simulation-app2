<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($qualifications as $qualification)
            <tr>           
                <td>{{$qualification->qualification_code}}</td>
                <td><a href="{{ route('admin.qualification.show', $qualification->id)}}">{{$qualification->title}}</a></td>    
                <td>@include('backend.qualification.includes.actions', ['qualification'=>$qualification] )</td>        
            </tr>
            @endforeach    
        </tbody>
    </table>
</div>
