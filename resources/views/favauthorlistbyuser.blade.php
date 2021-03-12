<div class="row">
                    <div class="col-md-12">
                    <br />
                    <h3 align = "center"> Favourite Author List </h3>
                     <br />
                     <table class="table table-bordered">
                     <tr>
                     <th>Author Name</th>
                     
                     </tr>
        

                      <tbody>

                      

                        @foreach($query as $value)

                            <tr>

                               <td>{{ $value->authorname }}</td>
                               

                               </tr>

                               @endforeach

                             </tbody>


                    
                     </table>
                    </div>
                    </div>