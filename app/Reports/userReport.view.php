
<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\datagrid\DataTables;

?>
 
 <div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Exporting user</h1>
       
		
        <form>
			<button type="submit" class="btn btn-primary" method="POST" formaction="/exportkooluser">Download Excel</button>

        
		</form>

        

	</div>


<?php
 DataTables::create(array(
    "dataStore"=>$this->dataStore('users'),
        "columns"=>array(
            
            
                "name"=>array(
                    "label"=>"User Name"
                ),
                "email"=>array(
                    "label"=>"Email ID"
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





		