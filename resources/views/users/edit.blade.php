@extends('layouts.admin')

@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="users">Users</a></li>
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">





      
      <h1>Update Users</h1>

        
<form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
    @method('PATCH') 
    @csrf
    <div class="form-group">

        <label for="name"> User Name:</label>
        <div class="col-md-6">
        <input type="text"  class="form-control"  name="name" value={{ $user->name }} {{ $user->name ? 'readonly' : '' }} required=true />
    </div>
   </div>
     
    <div class="form-group">
        <label for="email">Email</label>
        <div class="col-md-6">
        <input type="email" class="form-control"  name="email"   value={{ $user->email }}  {{ $user->email ? 'readonly' : '' }} required=true />
    </div>
    <div>

    <div class="form-group">
        <label for="password">Password</label>
        <div class="col-md-6">
        <input type="password"  class="form-control"  name="password" placeholder="Password..." minlength="8">
    </div>
    </div>

      <div class="form-group">
        <label for="password_confirmation">Password Confirm</label>
        <div class="col-md-6">
        <input type="password"  class="form-control" name="password_confirmation"  placeholder="Password..." id="password_confirmation">
      </div>
      </div>
    
        

        
     <div class="form-group">
                                <div class="col-md-12">
                                    <label for="gender">{{ __('Gender *') }}</label>
                            <div class="form-check form-check-inline" >
                                <!--<input class="form-check-input" type="radio" name="gender"  value={{$user->gender}}  {{ $user->gender ? 'readonly' : '' }} required=true  autocomplete="gender">-->
                                <input type="radio" name="gender" value="male" {{ $user->gender ? 'checked' : '' }}/>

                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                
                                <input type="radio" name="gender" value="female"   {{ $user->gender ? 'checked' : '' }}/>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                                </div>

                        </div>
                                



                  <div class="form-group ">
                            <label for="dob">{{ __('Date OF Birth') }}</label>
                            <div class="col-md-6">
                      <input id="dob" type="date" class="form-control" name="dob" value={{ $user->dob}}   optional>
                       
                      </div>
                      </div>
                      

                      <div class="form-group ">
                        <label for="profile_picture" >{{ __('profile_picture') }}</label>

                        <div class="col-md-6">
                             <input type="file" class="form-control" name="profile_picture" id="profile_picture" optional>
                        </div>
                    </div>
                     




    

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
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
                            read: "http://localhost:8000/readrole"
                           // type: "GET",
                          //dataType: "json"
                        }
                    }
        });
        


       
      });
    
    </script>






@endsection
@endsection