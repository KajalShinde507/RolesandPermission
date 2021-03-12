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

    <style>
   .data{
    
  overflow: auto; 
}
   
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 100%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  margin:auto;
  left:0;
  right:0;
  top:0;
  bottom:0;
  position:fixed;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
   
.pageloader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
   
    #filter{
  top: 0px;
  right: 40px;
}

h4{
  right: 50%;
  top: 10px;
}
.k-window  div.k-window-content
{
        overflow: hidden;
}


</style>

 @endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
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
      <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            

            <div class="card-body">
         <div class="text-center">
  <h4 class="d-inline">SaleReport</h4>
  <button class="btn btn-success  float-right" id="undo" style="margin-right: 80px;" >Filter</button>
  </div>              
        

  </div>
  </div>
  </div>
  </div>    
</div>
</div>
</section>

<div id="windowForAssign" style="display:none;">
      
<!DOCTYPE html>
   <html lang="en">
   <head>
  <style> html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
 <meta charset="utf-8"/>
   <meta name="csrf-token" content="{{csrf_token()}}">
   <meta name="_token" content="{{csrf_token()}}">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.common.min.css" />
   <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.silver.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.silver.mobile.min.css" />
    
    <style>
 
 .label {
  display: flex;
  flex-direction: row;
  justify-content: flex-end;
  text-align: right;
  width: 400px;
  line-height: 26px;
  margin-bottom: 10px;
}

.input {
  height: 20px;
  flex: 0 0 200px;
  margin-left: 10px;
}
 
</style>
      
   </head>
   <body>
   <div class="col-lg-12">
    <div class="form-group row">
        <label for="treadname" class="col-md-2 col-form-label">{{ __('Tread Name*') }}</label>
        <div class="col-md-3">
            <input id="treadname" class="form-control col-xs-2" style="height: 20px;" />
        </div>
        <label for="return period" class="col-md-2 col-form-label">{{ __('Return Period *') }}</label>
        <div class="col-md-3">
            <input id="returnperiod" class="form-control col-xs-4" style="height: 20px; width:98%;" />
            
        </div>
    </div>
 </div>




 <div class="col-lg-12">
    <div class="form-group row">
        <label for="doctype" class="col-md-2 col-form-label" style="height: 20px;">{{ __('Doc Type') }}</label>
        <div class="col-md-3">
            <input id="doctype" class="form-control col-xs-2" style="height: 20px;" />
        </div>
        <label for="status" class="col-md-2 col-form-label" style="height: 20px; ">{{ __('Status') }}</label>
        <div class="col-md-3">
            <input id="status" class="form-control col-xs-2" style="height: 20px;" />
            <div></div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="form-group row">
        <label for="category" class="col-md-2 col-form-label" style="height: 20px;">{{ __('Category') }}</label>
        <div class="col-md-3">
            <input id="category" class="form-control col-xs-2" style="height: 20px;" />
        </div>
        <label for="summary" class="col-md-2" style="height: 20px;">{{ __('Summary Type') }}</label>
        <div class="col-md-3">
            <div class="form-check form-check-inline">
                <input type="radio" name="summary" value="Line-level" style="height: 20px; margin-right: 5px;" />
                <label class="form-check-label" for="line">Line-level</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="summary" value="Invoice-level" style="height: 20px; margin-right: 5px;" />
                <label class="form-check-label" for="invoice">Invoice-level</label>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <button class="btn btn-success float-right"  id="sub" value="submit" type="submit">
        Submit
    </button>
</div>
<form class="exportform">
    @csrf
    <button type="button" class="btn btn-primary float-right" style="margin-right: 10px;" method="POST" id="export"><i class="fas fa-download"></i> Excel</button>
</form>
   <script src="https://kendo.cdn.telerik.com/2020.3.915/js/jquery.min.js"></script>
   <script src="https://kendo.cdn.telerik.com/2020.3.915/js/kendo.all.min.js"></script> 
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script>
      $(document).ready(function() {
          $("#treadname").kendoMultiSelect({
                optionLabel: "Select tread",
                  dataTextField: "gstin",
                  dataValueField: "gstin",
                  dataSource: {
                      type: "json",
                      transport: {
                          read: {url: "getTradeNameDropDown.json",
                              type: "GET",
                              dataType: "json",
                              contentType: "application/json; charset=utf-8"
                          }
                      }
                  },
                  schema: {
                   data: function(data) {
                   alert(JSON.stringify(data));
                   return eval(data);
                   }
                   },   
      });
      
      
      $("#doctype").kendoMultiSelect({
                  optionLabel: "Select doctype",
                  dataTextField: "ref_short_desc",
                  dataValueField: "ref_short_desc",
                  dataSource: {
                      type: "json",
                      transport: {
                          read: {url: "getDocTypes.json",
                              type: "GET",
                              dataType: "json",
                              contentType: "application/json; charset=utf-8"
                          }
                      }
                  },
                  schema: {
                   data: function(data) {
                   alert(JSON.stringify(data));
                   return eval(data);
                   }
                   },   
      });
      
      $("#returnperiod").kendoDropDownList({
                  optionLabel: "Select returnperiod",
                  dataTextField: "fp_description",
                  dataValueField: "fp",
                  dataSource: {
                      type: "json",
                      transport: {
                          read: {url: "getFinPeriodDropdown.json",
                              type: "GET",
                              dataType: "json",
                              contentType: "application/json; charset=utf-8"
                          }
                      }
                  },
                  schema: {
                   data: function(data) {
                   alert(JSON.stringify(data));
                   return eval(data);
                   }
                   },   
      });
      
      
      $("#status").kendoMultiSelect({
                  optionLabel: "Select status",
                  dataTextField: "ref_short_desc",
                  dataValueField: "ref_code",
                  dataSource: {
                      type: "json",
                      transport: {
                          read: {url: "getStatusDropdown.json",
                              type: "GET",
                              dataType: "json",
                              contentType: "application/json; charset=utf-8"
                          }
                      }
                  },
                  schema: {
                   data: function(data) {
                   alert(JSON.stringify(data));
                   return eval(data);
                   }
                   },   
      });
      
      
      $("#category").kendoMultiSelect({
                  optionLabel: "Select invoice category",
                  dataTextField: "invoice_category",
                  dataValueField: "invoice_category",
                  dataSource: {
                      type: "json",
                      transport: {
                          read: {url: "getInvCategoryDropdown.json",
                              type: "GET",
                              dataType: "json",
                              contentType: "application/json; charset=utf-8"
                          }
                      }
                  },
                  schema: {
                   data: function(data) {
                   alert(JSON.stringify(data));
                   return eval(data);
                   }
                   },   
      });
      
      
$("#export").click(function(){
      
      
      $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });
      
        
      
              
      
      var selectedVal= $("#treadname").data("kendoMultiSelect");
      var value = selectedVal.value();
      
      var selectedVal1= $("#returnperiod").data("kendoDropDownList")
      var value1 = selectedVal1.value();
      
      var selectedVal1= $("#doctype").data("kendoMultiSelect");
      var doc = selectedVal1.value();
      
      
      var selectedVal2= $("#status").data("kendoMultiSelect");
      var value2= selectedVal2.value();
    
      var selectedVal3= $("#category").data("kendoMultiSelect");
      var value3 = selectedVal3.value();
      
      var summradio= $("input[name='summary']:checked").val();
      
      
      
      
       $.ajax({
           type:'post',
           url:'/exportkoolsale_rg',
           data:{
               gstin_uin_of_supplier : value,
              fp : value1,
             doctype :doc,
             status:value2,
            category:value3,
           summary:summradio
           },
           
           
           
           success: function(response){
           
              console.log(response); 
              $(".exportform").attr("action", "/downloadexcel");
                          $(".exportform").submit();
      
      
      
           }
      
          });
      });
      
      
      });
      
      
   </script>
</body>
</html>
</div>



  <div class="loader" style="display:none;" ></div>
<div class="data"></div>



@section('javascript')
      <script src="https://kendo.cdn.telerik.com/2020.3.915/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2020.3.915/js/kendo.all.min.js"></script> 





<script>
$(document).ready(function() {


  $("#sub").click(function(){

 

$.ajaxSetup({
              headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
          });
            
        
            setTimeout(function() {
              $("#windowForAssign").data("kendoWindow").close();
         }, 900);
         
         
          //$("#pageloader").fadeIn();
          //$(".loader").fadeIn();
          $(".loader").show();
         
var selectedVal= $("#treadname").data("kendoMultiSelect");
var value = selectedVal.value();

var selectedVal1= $("#returnperiod").data("kendoDropDownList")
var value1 = selectedVal1.value();

var selectedVal1= $("#doctype").data("kendoMultiSelect");
var doc = selectedVal1.value();


var selectedVal2= $("#status").data("kendoMultiSelect");
var value2= selectedVal2.value();
//console.log(value2);
var selectedVal3= $("#category").data("kendoMultiSelect");
var value3 = selectedVal3.value();

var summradio= $("input[name='summary']:checked").val();





 $.ajax({
     type:'post',
     url:'/salerg',
     data:{
         gstin_uin_of_supplier : value,
        fp : value1,
       doctype :doc,
       status:value2,
      category:value3,
     summary:summradio
     },
     
     
     
     success: function(response){
    
      //$("#pageloader").hide();
      $(".loader").hide();
        $(".data").html(response); 
       //$("#data").appendTo(response.html);
        console.log(response); 
     }

    });
});



$('button').click(Filter);

var kendoWindowAssign = $("#windowForAssign");
var title = "Filter Window";
function Filter(){
  kendoWindowAssign.kendoWindow({
    width: "900px",
    modal: true,
    height: '280px',
    iframe: true,
    resizable: false,
    title: title,
    visible: false
  });

  var popup = $("#windowForAssign").data('kendoWindow');
  popup.center();
  popup.open();
 
}

});    
</script>
     
@endsection
@endsection