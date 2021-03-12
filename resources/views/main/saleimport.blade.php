@extends('layouts.admin')
@section('style')
<meta charset="utf-8"/>
   
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta name="_token" content="{{ csrf_token() }}">
   @endsection


@section('content')



 <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">sales Information</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main">salesdata</a></li>
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
        
      
            
	
            <ul>
                @foreach($errors->all() as $error)
	
                <li>	{{ $error }}</li>
	                   @endforeach
    
                   </ul> 
                      </div>
                        @endif
          
           
            

            <form class="file-upload" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" name="import_file" id="import_file" />
                        <br>
                        <br>
                        <button class="btn btn-success btn-sm" id="upload_csv" type="submit">Import CSV or Excel File</button>
                    </form>



        </div>

        <div class="msg"></div>

    
</div>
</section>


@section('javascript')
      <script src="https://kendo.cdn.telerik.com/2020.3.915/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2020.3.915/js/kendo.all.min.js"></script> 





<script>




$(document).ready(function(){
        $('form').submit(function(event){

            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                url: "{{url('/importsale_rg')}}",
                data: formData,
                type: 'post',
                async: false,
                processData: false,
                contentType: false,
                success:function(response){
                
                  $(".msg").html(response.message); 
                  console.log(response);
                  
                   
                }
               
    
            });

        });
    });


</script>



  @endsection
@endsection