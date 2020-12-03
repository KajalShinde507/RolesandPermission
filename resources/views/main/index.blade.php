@extends('base')

@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
<<!--script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="token" content="{{csrf_token()}}">
    <title>Books</title>
</head>

<body>

<div class="row">
<div class="col-sm-12">
    <h1>Books</h1>  
    <div class="table-responsive">  
       <table class="table table-striped">
        <thead>
        <tr>
          <td>ID</td>
          <td>BookName</td>
          <td>author</td>
          <td>email</td>
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
            <td>{{$value->authors->email}}</td>
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
      {{$book->links()}} 
   </div>
    </div>           
    </div> 
</div>


       <div>
        <form action="{{url('/test1')}}" method="POST">
          @csrf
         <div>
       <button   id="save" onclick="ajaxRequestFun();">Send Email</button>
      
       </div>
  
    </div>
    </form>          





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

            <form action="{{ url('/import') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <input type="file" name="file" class="form-control">

                <br>
                


                <button class="btn btn-success">Import Books Data</button>

              <!--  <a class="btn btn-warning" href="{{ url('export') }}">Export User Data</a>-->

            </form>
            <form method="POST" action="{{ url('/exportbook') }}">
               {{ csrf_field() }}
               <input type="submit" name="exportexcel" value='Excel Export'>
               <input type="submit" name="exportcsv" value='CSV Export'>
              </form> 

        </div>

    </div>

</div>
    
</body>
</html>




@section('js')




<script>
function ajaxRequestFun()

$.ajax({
        type:'POST',
        url:'{{url("/test1")}}',
        datatype:'json',
        
        
    });
}
</script>

@endsection













@endsection