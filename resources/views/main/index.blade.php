@extends('base')

@section('main')



<div class="row">
<div class="col-sm-12">
    <h1>Books</h1>    
 <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>BookName</td>
          <td>author</td>
          <td>price</td>
          
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($book as $value)
       
        
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->bookname}}</td>
            <td>{{$value->authors->authorname}}</td>
            <td>{{$value->price}}</td>
            
            <td>
                <a href="{{ route('main.edit',$value->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('main.destroy', $value->id)}}" method="post">
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
    <a style="margin: 19px;" href="{{ route('main.create')}}" class="btn btn-primary">New Books</a>
    </div> 
   <div class=" text-center"> {{$book->links()}} </div>
    </div>
    </div> 
</div>

@endsection