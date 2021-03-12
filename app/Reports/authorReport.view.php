
<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\datagrid\DataTables;

?>
 <div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Exporting Author</h1>
       
		
        <form>
			<button type="submit" class="btn btn-primary" method="POST" formaction="/exportkoolauth">Download Excel</button>
       </form>
        </div>


<?php
 DataTables::create(array(
    "dataStore"=>$this->dataStore('together'),
        "columns"=>array(
            
            
          
                "authorname"=>array(
                    "label"=>"Author Name"
                ),
                
                "email"=>array(
                    "label"=>"Email"
                ),
                "book_written"=>array(
                    "label"=>"Book_Written By Author"
                ),

                "status"=>array(
                
                    "label"=>"Status",
                    
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







		