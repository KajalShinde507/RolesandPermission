@extends('layouts.admin')

@section('style')
   <meta charset="utf-8"/>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta name="_token" content="{{ csrf_token() }}">
    
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
            <h1 class="m-0 text-dark">BOOK Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
<section class="content">
      <div class="container-fluid">
     <div id="example">
      <div id="grid">
      </div>
@can('isAdmin')
<div>
<a style="margin: 19px;" href="{{ url('main/create')}}" class="btn btn-primary">New Book</a>
</div>
@endcan
 <div>
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
                            url: "http://localhost:8000/read",
                            dataType: "json"
                        },
                      
                        parameterMap: function(options, operation) {
                            if (operation !== "read" && options.models) {
                                return {models: kendo.stringify(options.models)};
                            }
                        },   
                        parameterMap: function(data, type) {
                           if (type == "destroy") {
                     
                             return { models: kendo.stringify(data.models) }
                            }
                         }
                    },
                   
                    pageSize:4,
                    schema: {
                        
                        model: {
                            id: "id",
                           fields: {
                                       id: { type: "number", editable: false, nullable: false },
                                       bookname: { validation: { required: true } },
                                      author: { validation: { required: true } },
                                     price: { type: "number", validation: { min: 0, required: true } }
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
                { field: "bookname", title: "Book Name", width: "200px" },
                 { field: "author",
                       width: "200px",
                       dataTextField: "authorname",
                       dataValueField: "id",
                       dataSource: {
                       
                       transport: {
                            read: "http://localhost:8000/readauthor"
                        }
                         },
                    title: "Author Name" 
                    },
                
                { field: "price", title:"Price", width: "200px" },
                   { field: "is_fav",
                    hidden: true
                     },    
                  @can('isAdmin')
                    {
                      title: "Action",
                   template: "<a href='{{ url('main/#=id#/edit')}}'  class='btn btn-primary'>Edit</a>&nbsp;&nbsp;<a href='{{ url('main/destroy/#=id#')}}' method='post'  <button class='btn btn-danger' type='submit'>Delete</button>", 
                   filterable: false,
                    width: "200px"
                    },
                  @endcan
                  
                   @can('isUser')
                    {
                      title: "Favourite/Unfavourite",
                      template: "#if(is_fav){#<button id='addfavourites' onClick='addToFavourites(book_id=#=id#, {{ Auth::user()->id }},this) '  class='addfavourite' >favourite</button>#}else{#<button id='addfavourites' onClick='addToFavourites(#=id#,{{ Auth::user()->id }},this) '  class='addfavourite #=id#' >unfavourite</button>#}#",
                       width: "200px"
                   }
                   @endcan
                  
                   ],
                  editable: true,
            });

        });
      function addToFavourites(bid, userid,obj) {
             var user_id = userid;
             var book_id = bid;
  
            $.ajaxSetup({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });

           $.ajax({
          type: 'post',
        
        url: '/addfavourite',
        data: {
            'user_id': user_id,
            'book_id': book_id,
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


     



