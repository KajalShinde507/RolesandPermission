<!DOCTYPE html>

<html>

<head>

    <title>Laravel </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

</head>

<body>



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

            <form action="{{ url('/import') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <input type="file" name="file" class="form-control">

                <br>
                


                <button class="btn btn-success">Import Books Data</button>

                <!--<a class="btn btn-warning" href="{{ url('export') }}">Export User Data</a>-->

            </form>

        </div>

    </div>

</div>
<div class="row">
<div class="col-sm-12">
    <h6> existing Books</h6>  
    <div class="table-responsive">  
 <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>BookName</td>
          <td>author_id</td>
          
          <td>price</td>
          
          
        </tr>
    </thead>
    <tbody>
        @foreach($book as $value)
       
        
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->bookname}}</td>
            <td>{{$value->author}}</td>
            
             <td>{{$value->price}}</td>
             @endforeach
       
       </tbody>
     </table>
     </div>
     </div>
     </div>
    
            
</body>
</html>


</body>

</html>