<div>

@if(count($errors) > 0)
           
           <div class="alert alert-Danger" role="alert">
       
       Upload Validation Error<br><br>
           <ul>
               @foreach($errors->all() as $error)
   
               <li>	{{ $error }}</li>
                      @endforeach
   
                  </ul> 
                     </div>
                       @endif
          @if($message = Session::get('success'))

        <div class="alert alert-success" role="alert">
 
           <strong>{{ $message }} </strong>

      </div>
        @endif
     <div>



     
     <h1>Update Users</h1>


      <img src="/Uploads/{{$user->profile_picture }}" style=" height=100px; width=100px;border-radius:50% "/> 
<form method="post" action="{{ url('users/updateuser',$user->id)}}"  enctype="multipart/form-data">
@method('PATCH') 
   @csrf

   
   <div class="form-group">

       <label for="name"> User Name:</label>
       <div class="col-md-6">
       <input type="text"  class="form-control"  name="name" value={{ $user->name }}    {{ $user->name ? 'readonly' : '' }} required=true/>
       
   </div>
  </div>
    
   <div class="form-group">
       <label for="email">Email</label>
       <div class="col-md-6">
       <input type="email" class="form-control"  name="email"   value={{ $user->email }} {{ $user->email ? 'readonly' : '' }} required=true/>
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