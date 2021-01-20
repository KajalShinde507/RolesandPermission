@extends('layouts.admin')
@section('style')
   <meta charset="utf-8"/>
    <!--<base href="https://demos.telerik.com/kendo-ui/grid/index?autoRun=true&theme=silver">-->
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
    
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.common.min.css" />
   <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.silver.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.silver.mobile.min.css" />
    <!--<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.default.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.default.mobile.min.css" />-->
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
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
      
  
      <form method="post" action="{{ route('main.store') }}">
          @csrf
          <div class="form-group">    
              <label for="bookname"> BookName:</label>
              <input type="text" class="form-control" name="bookname"/>
          </div>

         <div class="form-group">
                <label for="author">Author:</label>
                <div class="col-md-6">
              <input id="dropdownlist" class="form-control"   name="author" />
            </div>
            </div>

          <div class="form-group">
              <label for="price">price:</label>
              <input type="number" class="form-control" name="price"/>
          </div>
          
          <button type="submit" class="btn btn-primary">Add books</button>
      </form>
  


      </div><!-- /.container-fluid -->
    </section>




    @section('javascript')
      <script src="https://kendo.cdn.telerik.com/2020.3.915/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2020.3.915/js/kendo.all.min.js"></script> 

    <script>




$(document).ready(function() {
  $("#dropdownlist").kendoDropDownList({
   
                    dataTextField: "authorname",
                    dataValueField: "author",
                    
             dataSource: {
                  
                  transport: {
                      read: "http://localhost:8000/readauthor"
                     
                  }
              }
  });

  $("#dropdownlist").data("kendoDropDownList").list.width("auto");
 
});

</script>


@endsection
@endsection