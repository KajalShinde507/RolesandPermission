<div class="row">
                    <div class="col-md-12">
                    <br />
                    <h3 align = "center"> Favourite Book List </h3>
                     <br />
                     <table class="table table-bordered">
                     <tr>
                     <th>Book Name</th>
                     
                     </tr>
        

                      <tbody>

                      

                        @foreach($query as $value)

                            <tr>

                               <td>{{ $value->bookname }}</td>
                               

                               </tr>

                               @endforeach

                             </tbody>


                    
                     </table>
                    </div>
                    </div>