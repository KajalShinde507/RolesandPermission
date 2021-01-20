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

    
            


<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1>Add Author details</h1>
<form method="post" action="{{ route('users.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name"> User Name:</label>
              <input type="text" class="form-control" name="name"/>
          </div>

          <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email"/>
          </div>
         
          <div class="form-group">
        <label for="password">Password</label>
        
        <input type="password"  class="form-control"  name="password" placeholder="Password..." minlength="8">
    
    </div>

      <div class="form-group">
        <label for="password_confirmation">Password Confirm</label>
        
        <input type="password"  class="form-control" name="password_confirmation"  placeholder="Password..." id="password_confirmation">
      
      </div>




          <div class="form-group">
                <label for="role">Role:</label>
                <div class="col-md-6">
              <input id="dropdownlist" class="form-control"   name="role" />
            </div>
            </div>
          
          <button type="submit" class="btn btn-primary">Add Author</button>
      </form>
  </div>
</div>

    
</div>
</section>





@section('javascript')
      <script src="https://kendo.cdn.telerik.com/2020.3.915/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2020.3.915/js/kendo.all.min.js"></script> 


<script>




      $(document).ready(function() {
        $("#dropdownlist").kendoDropDownList({
         
                   dataTextField: "name",
                    dataValueField: "id",
                    
                   dataSource: {
                        
                        transport: {
                            read: "http://localhost:8000/readroleonly"
                           // type: "GET",
                          //dataType: "json"
                        }
                    }
        });
        


       
      });
     
    </script>




@endsection
@endsection