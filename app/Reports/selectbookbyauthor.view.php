<?php
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\inputs\Select;
    use \koolreport\datagrid\DataTables;

    $authorname = "";
    $this->dataStore("authors")->popStart();
    while($row = $this->dataStore("authors")->pop())
    {
        if($row["author"]==$this->params["author"])
        {
            $authorname =$row["authorname"];
        }
    }




?>  


     

<form method="POST" action="bookselectreport" >
<button type="submit" class="btn btn-primary" method="POST" formaction="/exportkoolbookbyauthor">Download Excel</button>
<input type="hidden" name="_token" id="csrf-token" value= "<?php echo Session::token() ;?>" />
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <b>Select books</b>
                    <?php 
                    
                    Select::create(array(
                        'name'=>"author",
                        "multiple"=>true,
                        "placeholder"=>"Select authors",
                        "dataStore"=>$this->dataStore("authors"),
                        "dataBind"=>array(
                            "text"=>"authorname",
                            "value"=>"author",
                        ),
                        "defaultOption"=>array("--"=>""),

                        "clientEvents"=>array(
                            "change"=>"function(e){
                                console.log($(this).val());
                            }",
                        ),
                        
                        "attributes"=>array(
                            "class"=>"form-control"
                        )

                    ));
                    ?>
                </div>  
                <div class="form-group">
                    <button class="btn btn-primary">Submit</button>
                </div>    
            </div>
        </div>
        
    </form>





   

    
   <?php
 DataTables::create(array(
    "dataStore"=>$this->dataStore('together'),
        "columns"=>array(
            "bookname"=>array(
                "label"=>"Book Name"
            ),
            
                "authorname"=>array(
                    "label"=>"Author Name"
                ),
                
                    

            "price"=>array(
                "type"=>"number",
                "label"=>"Amount",
                
            ),

            

           
        ),
        "options"=>array(
            "paging"=>true
        ),
    "cssClass"=>array(
        "table"=>"table table-hover table-bordered"
    )
));
?>
          
     
</div>  