@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> book</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <form action="Submit" method="Post">

                     @csrf
                    <div class="form-group row">
                            <label for="bookname" class="col-md-4 col-form-label text-md-right">{{ __(' bookname') }}</label>

                            <div class="col-md-6">
                                <input id="bookname" type="text" class="form-control @error('bookname') is-invalid @enderror" name="bookname"required >

                                @error('bookname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('author') }}</label>

                            <div class="col-md-6">
                                <input id="author" type="number" class="form-control @error('price') is-invalid @enderror" name="author">

                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
