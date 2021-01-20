@extends('layouts.admin')

@section('style')
    <base href="https://demos.telerik.com/kendo-ui/grid/index?autoRun=true&theme=silver">
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
    
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.silver.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.silver.mobile.min.css" />
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
     
      
    <table id="grid">
        
        <thead>
            <tr>
                <th data-field="id">id</th>
                <th data-field="bookname">bookname</th>
                <th data-field="author">author</th>
                <th data-field="price">price</th>
                
            </tr>
        </thead>
        <tbody>
        @foreach($books as $value)

<tr>

<td>{{$value->id}}</td>
<td>{{$value->bookname}}</td>
<td>{{$value->authors->authorname}}</td>
<td>{{$value->price}}</td>
 

   </tr>

   @endforeach
  
 </tbody>

 
    </table>

      
@section('javascript')
      <script src="https://kendo.cdn.telerik.com/2020.3.915/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2020.3.915/js/kendo.all.min.js"></script>
<script>
        $(document).ready(function() {
            $("#grid").kendoGrid({
               height: 550,
                dataSource: {
    
    
   pageSize:5,
  },
  
               pageable: {
                
        refresh: true,
        pageSizes: true
      
    },
   
    
            });
        });
    </script>
    
    </div>
      </section>
 
@endsection
@endsection


     



