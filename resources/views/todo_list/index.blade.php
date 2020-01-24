@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">  
            <div class="col-md-12">
                <h3>ToDo Lists</h3>
                <form action="{{route('todolists.store')}}" method="POST">
                @csrf
                    <div class="input-group mb-3"> 
                        <input type="text" class="form-control" name="description" placeholder="Enter Task Name" aria-label="Enter Tasks" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Add</button>
                        </div>    
                    </div>
                </form> 
            </div>   
         </div>
    
         <div class="row">
            <div class="col-md-6">
                <ul class="list-group">
                <li class="list-group-item">Uncompleted List</li>
                    @foreach($todolists as $todolist)
                        <li class="list-group-item"><input type="checkbox" id="complete{{$todolist->id}}" value={{$todolist->id}} onChange="complete({{$todolist->id}});"> {{$todolist->description}}</li>
                    @endforeach
                </ul> 
            </div>           
        
        <div class="col-md-6row">
            <ul class="list-group">
            <li class="list-group-item">Completed List</li>
                @foreach($complete_todolists as $complete_todolist)
                    <li class="list-group-item"> {{$complete_todolist->description}}</li>
                @endforeach
            </ul> 
        </div>
    
    </div>
<script>

    function complete(id){
        $.ajax({
            url: '/todolists/complete',
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id
            },
            type: 'POST'
        }).done(function(response) {
            if(response == "success"){
                location.reload();
            }
        });
    }

</script>

@endsection