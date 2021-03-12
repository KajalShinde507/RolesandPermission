@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Sale Report</h1>
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



      <table class="table no-margin text-center table-striped">
          <thead>
            <tr>
              <th>gstin_uin_of_supplier</th>
              <th>doc_type</th>
              <th>gstin_of_customer</th>
              <th>ecom_gstin</th>
              <th>customer_name</th>
              <th> invoice_no<th>
              <th> invoice_date</th>
              <th> invoice_category</th>
               <th>item_name</th>
               <th> hsn_sac_code</th>
               <th> uom</th>
               <th> quantity</th>
               <th> item_rate</th>
               <th> taxable_amt </th>
              </tr>
          </thead>






<tbody>
@foreach($sale as $key => $data)
            <tr>
              <td>{{$data->gstin_uin_of_supplier}}</td>
              <td>{{$data->doc_type}}</td>
              <td>{{$data->gstin_of_customer}}</td>
              <td>{{$data->ecom_gstin}}</td>
              <td>{{$data->customer_name}}</td>
              <td> {{$data->invoice_no}}<td>
              <td> {{$data->invoice_date}}</td>
              <td> {{$data->invoice_category}}</td>
               <td>{{$data->item_name}}</td>
               <td> {{$data->hsn_sac_code}}</td>
               <td> {{$data->uom}}</td>
               <td> {{$data->quantity}}</td>
               <td> {{$data->item_rate}}</td>
               <td> {{$data->taxable_amt}} </td>
              </tr>
              @endforeach
            </tbody>  

</table>
</div>
</section>
@endsection