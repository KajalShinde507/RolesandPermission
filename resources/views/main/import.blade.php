@extends('layouts.admin')

@section('content')



 <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Books Information</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main">Book data</a></li>
              <li class="breadcrumb-item active"><a href="home">home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->


        

        
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






    
</div>
</section>
@endsection
<!-- /.card -->

        <!-- right col -->
        <!--</div>
        </.row (main row) -->
     <!-- </div><!- /.container-fluid -->
    <!--</section>
    <!- /.content -->
  <!--</div>
  <!- /.content-wrapper -->

  