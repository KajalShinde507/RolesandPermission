@extends('base1')

@section('sub')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1>Add Author details</h1>
  
      <form method="post" action="{{ route('sub.store') }}">
          @csrf
          <div class="form-group">    
              <label for="authorname"> AuthorName:</label>
              <input type="text" class="form-control" name="authorname"/>
          </div>

          <div class="form-group">
              <label for="email">email:</label>
              <input type="text" class="form-control" name="email"/>
          </div>

         
          
          <button type="submit" class="btn btn-primary">Add Author</button>
      </form>
  </div>
</div>
</div>
@endsection