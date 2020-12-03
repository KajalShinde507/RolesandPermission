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



<div class="container">

    <div class="card bg-light mt-3">

        <div class="card-header">

             Import Export Excel 

        </div>

        <div class="card-body">

        @if(count($errors) > 0)
            
            <div class="alert alert-Danger" role="alert">
        
        Upload Validation Error<br><br>
            
	
            <ul>
                @foreach($errors->all() as $error)
	
                <li>	{{ $error }}</li>
	                   @endforeach
    
                   </ul> 
                      </div>
                        @endif


           @if($message = Session::get('success'))
 
         <div class="alert alert-success" role="alert">
  
            <strong>{{ $message }} </strong>

       </div>
         @endif

            <form action="{{ url('/importauth') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <input type="file" name="file" class="form-control">

                <br>
                


                <button class="btn btn-success">Import Authors Data</button>

                <!--<a class="btn btn-warning" href="{{ url('export') }}">Export User Data</a>-->

            </form>
            </form>
            <form method="POST" action="{{ url('/exportauth') }}">
               {{ csrf_field() }}
               <input type="submit" name="exportexcel" value='Excel Export'>
               <input type="submit" name="exportcsv" value='CSV Export'>
              </form>

        </div>

    </div>
@endsection