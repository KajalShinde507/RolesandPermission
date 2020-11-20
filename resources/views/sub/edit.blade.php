@extends('base1') 
@section('sub')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1>Update Author Details</h1>

        
        <form method="post" action="{{ route('sub.update', $author->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="bookname"> AuthorName:</label>
                <input type="text" class="form-control" name="authorname" value={{ $author->authorname }} />
            </div>

            <div class="form-group">
                <label for="author">email:</label>
                <input type="text" class="form-control" name="email" value={{ $author->email }} />
            </div>

            
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection