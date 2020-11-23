@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Author list</div>

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
                    <h3 align = "center">  Authors list </h3>
                     <br />
                     <table class="table table-bordered">
                     <tr>
                     <th>ID</th>                
                     <th>AuthorName</th>
                  
                     <th>email</th>
                     
                     </tr>
        

                      <tbody>

                      

                        @foreach($authors as $value)

                            <tr>

                            <td>{{$value->id}}</td>
                            <td>{{$value->authorname}}</td>
                        
                             <td>{{$value->email}}</td>

                               </tr>

                               @endforeach

                             </tbody>


                    
                     </table>
                     {{$authors->links()}}
                    </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
