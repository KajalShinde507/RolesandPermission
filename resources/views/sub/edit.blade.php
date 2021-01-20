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
        <!-- Small boxes (Stat box) -->
        <div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1>Update Authors</h1>

        
        <form method="post" action="{{ route('sub.update', $author->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="authorname"> AuthorName:</label>
                <input type="text" class="form-control" name="authorname" value={{ $author->authorname }} />
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input  type="text" class="form-control" name="email" value={{ $author->email }} />
            </div>
           
           
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>    

</div>
</section>



@endsection
