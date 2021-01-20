@extends('layouts.admin')
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
 <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">send email</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main">Book data</a></li>
              <li class="breadcrumb-item active"><a href="home">home</li>
            </ol>
          </div>
        </div>
      </div>
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
      <div>
        <form action="{{url('/sentmail')}}" method="POST">
          @csrf
         <div>
       <button   id="save" onclick="ajaxRequestFun();">Send Email</button>
      </div>
      </div>
    </form>  
</div>
</section>
@section('javascript')

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

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


  