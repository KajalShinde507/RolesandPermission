@extends('layouts.admin')

@section('style')
   <meta charset="utf-8"/>
   
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta name="_token" content="{{ csrf_token() }}">
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
     
     
      
    
      <div id="example">
      <div id="grid">
      
</div>
@can('isAdmin')
<div>
<a style="margin: 19px;" href="{{ url('sub/create')}}" class="btn btn-primary">New Author</a>
</div>
@endcan

</section>
@section('javascript')
      <script src="https://kendo.cdn.telerik.com/2020.3.915/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2020.3.915/js/kendo.all.min.js"></script> 
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script>
      



        $(document).ready(function () {
            
                dataSource = new kendo.data.DataSource({
                    autoSync: true,
                    transport: {
                        read:  {
                            url: "http://localhost:8000/readauthor",
                            dataType: "json"
                        },
                        update: {
                           
                            url:  "http://localhost:8000/main/update",
                            dataType: "json",
                            
                            
                        },
                        destroy: {
                            url: "http://localhost:8000/main/destroy",
                            dataType: "json"
                        },
                        create: {
                            url: "http://localhost:8000/main/create",
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
                                authorname: { validation: { required: true } },
                                email: { validation: { required: true } },
                                author: { validation: { required: true } }
                               
                                
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
                
                   
                 { field: "authorname", title: "Author Name", width: "200px" },
                  { field: "email", title:"Email", width: "200px" },


                 
                  @can('isAdmin')
                    {
                      title: "Action",
                      template: "<a href='{{ url('sub/#=id#/edit')}}'  class='btn btn-primary'>Edit</a>&nbsp;&nbsp;<a href='{{ url('sub/destroy/#=id#')}}'  <button class='btn btn-danger' type='submit'>Delete</button>"
                   
                         ,filterable: false,
                         width: "200px" 
                    },
                    @endcan
                    @can('isUser')
                    {
                     title: "Favourite/Unfavourite",
                     
                     template: "<button id='addfavourites' onClick='addToFavourites(author_id=#=id#, {{ Auth::user()->id }},this) '  class='addfavourite' >favourite</button>",
                     width: "200px"
                    }
                  @endcan
                  
                   ],
                

                    
                    });
                      
                  });
function addToFavourites(bid, userid,obj) {
      
         var user_id = userid;
          var author_id = bid;
   
            $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
  
           $.ajax({
          type: 'post',
      
          url: '/addfavouritesauth',
          data: {
              'user_id': user_id,
              'author_id': author_id,
           
          },
        
  
          success:function( data ) {
       
       $(obj).text($(obj).text() == 'favourite' ? 'unfavourite': 'favourite');
  
      },
          error: function (XMLHttpRequest) {
              
          }
         
         
      });
      
     
  }

</script>
</div>
@endsection
@endsection


     



