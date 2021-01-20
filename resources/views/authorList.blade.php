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
     
      <div id="example">
    
    <table id="grid">
    <thead>
            <tr>
                <th data-field="id">id</th>
                <th data-field="authorname">Authorname</th>
                <th data-field="email">email</th>
                
                
            </tr>
        </thead>
        </table></div>
    @section('javascript')
      <script src="https://kendo.cdn.telerik.com/2020.3.915/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2020.3.915/js/kendo.all.min.js"></script> 
    
      
    <script>
        $(document).ready(function() {
            $("#grid").kendoGrid({
                dataSource: {
                    
                    transport: {
                        read: "http://localhost:8000/authorlist"
                    },
                    schema: {
                        model: {
                            fields: {
                                ID: { type: "number" },
                             
                                AuthorName: { type: "string" },
                                email: { type: "string" }
                                
                            }
                        }
                    },
                    pageSize: 4,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true
                },
                height: 550,
                filterable: true,
                sortable: true,
                pageable: true,
                columns: [{
                        field:"ID",
                        filterable: false
                    },
                    
                    {
                        field: "authorname",
                        title: "authorname",
                        
                    }, {
                        field: "email",
                        title: "email"
                    }
                ]
            });
        });
        
    </script>
    </div>
    </div>
      </section>
 
@endsection
@endsection


     



