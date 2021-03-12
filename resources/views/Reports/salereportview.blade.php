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
    <!--<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.default.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.915/styles/kendo.default.mobile.min.css" />-->
    <style>
    #pageloader
{
  background: rgba( 255, 255, 255, 0.8 );
  display: none;
  height: 100%;
  position: fixed;
  width: 100%;
  
  z-index: 9999;

}

 .fa-spin
{
  left: 35%;
  margin-left: 50px;
  margin-top: 50px;
  width: 50%;
  height: 50%;
  position: absolute;
  top: 20%;
}
.overlay {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 60%;
    
}

.section {
    width: 50%;
    float: left;
}

.form-section {
    clear: both;
}
</style>
       <title>Sale Report</title>
   </head>
   <body>
<div class="container">
    <div class="col-lg-12">
              <div class="form-group row">
         <label for="treadname" class="col-md-2 col-form-label"  style="margin-top:2%;">{{ __('Treadname*') }}</label>
                <div class="col-md-4">
                <input id="treadname"class="form-control col-xs-4"  style=" margin-top:7%;" />
                </div>
                

                
             <label for="return period" class="col-md-2" style="margin-top:2%;">{{ __('ReturnPeriod*') }}</label>
             <div class="col-md-4">
              <input id="returnperiod" class="form-control col-xs-3" style="margin-top:7%;" />
              <div>
            </div>
            </div>
            
            
            
           



            <div class="col-lg-6">
            <div class="form-group row">
                <label for="doctype" class="col-md-2 col-form-label" style="height:25px; margin-top:1%" >{{ __('DocType') }}</label>
                <div class="col-md-4">
                <input id="doctype" class="form-control col-xs-2" style="margin-top:3%"  />
            
            </div>


            
             <label for="status"   class="col-md-2 col-form-label" style="height:25px; margin-top:1%">{{ __('status') }}</label>
             <div class="col-md-4">
            <input id="status"  class="form-control col-xs-4"  style=" margin-top:3%"/>
            <div>
            </div>
            </div>

            
            <div class="col-lg-6">
            <div class="form-group row">
                     <label for="category" class="col-md-2 col-form-label" style="height:25px; margin-top:1%">{{ __('category') }}</label>
                <div class="col-md-4">
                <input id="category" class="form-control col-xs-2"  style="margin-top:3%"  />
               </div>
            
                         <label for="summary"  class="col-md-2" style="height:20px; margin-top:1%">{{ __('summaryType') }}</label>
                         <div class="col-md-4">
                           <div class="form-check form-check-inline " >
                          <input type="radio" name="summary" value="Line-level" style="margin-top:2%;"/>
                          <label class="form-check-label" for="line" style="margin-top:2%;">Line-level</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="summary" value="Invoice-level" style="margin-top:2%;" />
                                <label class="form-check-label" for="invoice" style="margin-top:2%;">Invoice-level</label>
                            </div>
                              
             </div>
            </div>


            <div class="form-group"> 
                     <button class="btn btn-success  float-right"  id="sub" value="submit" type="submit"> 
                      Submit  
                      </button> 
                  </div> 
           
                      <form class="exportform">
                       @csrf
			               <button type="button"   class="btn btn-primary float-right" style="margin-right: 5px;" method="POST"  id="export" >   <i class="fas fa-download"></i> Excel</button>
                 </form>
        
    
        
              
 
</div>


<div id="pageloader">
         <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
  </div>

 


   <div class="data">
  </div>




    @section('javascript')
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


   
        

$("#sub").click(function(){

    
$.ajaxSetup({
              headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
          });

         
    
          $("#pageloader").fadeIn();

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



//$(".loader").fadeOut("slow");

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
    
      $("#pageloader").hide();
        $(".data").html(response); 
       //$("#data").appendTo(response.html);
        console.log(response); 
     }

    });
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
//console.log(value2);
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
     // window.location = '/Upload/' + response;
    // window.location.href = response;
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

 









