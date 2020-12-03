<!doctype html>
 
<html>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
 
<body>


   
<div>
 

<table class="table table-striped"   >
    <thead>
        <tr>
          
          <td> Top 5 BookNames</td>
          
        
          
        
        </tr>
    </thead>
   <tbody>

@foreach($book as $value)
       
        
       <tr>
           <td>
           <li>{{$value->bookname}} </li>
           
           </td>
           
           @endforeach

           </tbody>
  
</div>
</table>
</body>
</html>
        
                    
@endsection


