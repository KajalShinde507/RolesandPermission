@extends('layouts.admin')

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


      <h1>Update the Role</h1>

      <form method="post" action="/roles/{{$role->id}}">
            @method('PATCH') 
            @csrf

            <div class="form-group">
        <label for="name">Role name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Role name..." value="{{$role->name}}" required>


        <div class="form-group" >
        <label for="roles_permissions">Add Permissions</label>
        <input type="text" data-role="tagsinput" name="roles_permissions" class="form-control" id="roles_permissions" value="@foreach ($role->permissions as $permission)
            {{$permission->name. ","}}
        @endforeach">   
    </div>     

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>
    </div>



      </div>
      </section>
    




      

    <script>
        $(document).ready(function(){
            $('#name').keyup(function(e){
                var str = $('#rname').val();
              
            });
        });
        
    </script>

@endsection