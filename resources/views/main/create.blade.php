@extends('base')

@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1>Add books</h1>
  
      <form method="post" action="{{ route('main.store') }}">
          @csrf
          <div class="form-group">    
              <label for="bookname"> BookName:</label>
              <input type="text" class="form-control" name="bookname"/>
          </div>

          <div class="form-group">
              <label for="author">author:</label>
              <input type="number" class="form-control" name="author"/>
          </div>

          <div class="form-group">
              <label for="price">price:</label>
              <input type="number" class="form-control" name="price"/>
          </div>
          
          <button type="submit" class="btn btn-primary">Add books</button>
      </form>
  </div>
</div>
</div>
@endsection