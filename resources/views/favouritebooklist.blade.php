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
            <h1 class="m-0 text-dark">  Favourited Book List Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="users">user</a></li>
              <li class="breadcrumb-item active">home</li>
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

        <div id="example">
      <div id="grid">
      
</div>





</section>
@section('javascript')
      <script src="https://kendo.cdn.telerik.com/2020.3.915/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2020.3.915/js/kendo.all.min.js"></script> 

<script>

$(document).ready(function () {
            
            dataSource = new kendo.data.DataSource({
                autoSync: true,
                transport: {
                    read:  {
                        url: "http://localhost:8000/readfavbook",
                        dataType: "json"
                    },
                  
                    
                   
                    parameterMap: function(options, operation) {
                        if (operation !== "read" && options.models) {
                            return {models: kendo.stringify(options.models)};
                        }
                    }
                },
               
                pageSize:4,
                schema: {
                    
                    model: {
                        id: "id",
                       fields: {
                        id: { type: "number", editable: false, nullable: false },
                            name: { validation: { required: true } },
                            
                           
                            
                        }
                    }
                },
                
             
            });

          
          
        $("#grid").kendoGrid({
            dataSource: dataSource,
            pageable: true,
            navigatable: true,
            height: 440,
           
            
            columns: [
            
               
             { field: "bookname", title: " Favourite By  Login User Book List", width: "400px" }

            
                
              
              
               ],
              
                
      });
});
</script>
</div>
@endsection
@endsection
  

















   

        


