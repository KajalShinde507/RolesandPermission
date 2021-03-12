@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name *') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address *') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row ">
                                <div class="col-md-12">
                                    <label for="gender" class= "col-md-4 col-form-label text-md-right">{{ __('Gender *') }}</label>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" type="radio" name="gender" value="male" required autocomplete="gender">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="female" required autocomplete="gender">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                                </div>

                        </div>
                                    


                            <div class="form-group row">
                            <label for="dob"class="col-md-4 col-form-label text-md-right" >{{__('Date OF Birth') }}</label>
                            <div class="col-md-6">
                      <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}" optional>
                       
                      </div>
                      </div>
                      

                      <div class="form-group row">
                        <label for="profile_picture" class="col-md-4 col-form-label text-md-right">{{ __('profile_picture ') }}</label>

                        <div class="col-md-6">
                             <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                        </div>
                    </div>



                        <div class="form-group row">
                            <label for="role"class="col-md-4 col-form-label text-md-right" >User Type:</label>
                                <div class="col-md-6">
                             <select class="form-control" name="role" id="role">
                             <option value="3">front user</option>
                             

                             </select>
                              </div>
                               </div>
                        
                       
                            

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
