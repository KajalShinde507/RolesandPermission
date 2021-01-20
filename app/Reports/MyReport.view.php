
<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\BarChart;
use \koolreport\datagrid\DataTables;

use \koolreport\pivot\widgets\PivotTable;


    use \koolreport\inputs\Select;

?>
 <div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Exporting book</h1>
       
		
        <form>
			<button type="submit" class="btn btn-primary" method="POST" formaction="/exportkool">Download Excel</button>

        
		</form>

</div>

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
                
                    "email"=>array(
                        "label"=>"Email"
                    ),

            "price"=>array(
                "type"=>"number",
                "label"=>"Amount",
                
            ),

            

            "favcount"=>array(
                
                "label"=>"Favourite Book By User",
                
            )
        ),
        "options"=>array(
            "paging"=>true
        ),
    "cssClass"=>array(
        "table"=>"table table-hover table-bordered"
    )
));
?>





		