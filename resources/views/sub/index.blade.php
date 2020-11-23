@extends('base1')

@section('sub')



<div class="row">
<div class="col-sm-12">
    <h1>Author</h1>  
    <div class="table-responsive">  
 <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>AthorName</td>
          <td>Email</td>
          
          
          
        </tr>
    </thead>
    <tbody>
        @foreach($author as $value)
       
        
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->authorname}}</td>
            <td>{{$value->email}}</td>
            

            <td>
                <a href="{{ route('sub.edit',$value->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('sub.destroy', $value->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
            </tr>
        @endforeach
        
    </tbody>
  </table>
 
<div>
    <a style="margin: 19px;" href="{{ route('sub.create')}}" class="btn btn-primary">New Authors</a>
    </div> 
    {{$author->links()}}
    </div>
    </div>
    </div> 
</div>
@endsection