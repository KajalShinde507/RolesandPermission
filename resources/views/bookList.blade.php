@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> book list</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in As  NONadmin!
                    
                    
                    <div class="row">
                    <div class="col-md-12">
                    <br />
                    <h3 align = "center"> books records </h3>
                     <br />
                     <table class="table table-bordered">
                     <tr>
                     <th>ID</th>                
                     <th>BookName</th>
                   <th>Authorname</th>
                     <th>price</th>
                     
                     </tr>
        

                      <tbody>

                      

                        @foreach($books as $value)

                            <tr>

                            <td>{{$value->id}}</td>
                            <td>{{$value->bookname}}</td>
                            <td>{{$value->authors->authorname}}</td>
                             <td>{{$value->price}}</td>

                               </tr>

                               @endforeach
                              
                             </tbody>


                    
                     </table>
                     {{$books->links()}}
                    </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
