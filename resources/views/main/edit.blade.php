@extends('base') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1>Update books</h1>

        
        <form method="post" action="{{ route('main.update', $book->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="bookname"> BookName:</label>
                <input type="text" class="form-control" name="bookname" value={{ $book->bookname }} />
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" name="author" value={{ $book->author }} />
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" name="price" value={{ $book->price }} />
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection