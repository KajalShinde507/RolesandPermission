
<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\datagrid\DataTables;
use \koolreport\widgets\google\BarChart;
?>
  <div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Exporting favouritebook</h1>
       
		
        <form>
			<button type="submit" class="btn btn-primary" method="POST" formaction="/exportkoolfav">Download Excel</button>

        
		</form>

        

	</div>



<?php
Table::create(array(
    "dataStore"=>$this->dataStore('together'),
        "columns"=>array(
            
            
                "bookname"=>array(
                    "label"=>"Book Name"
                ),
               

                
                "book_id"=>array(
                    "label"=>"Most Favourite Books"
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





		