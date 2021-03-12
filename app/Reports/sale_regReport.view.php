<?php
  use \koolreport\widgets\koolphp\Table;
  use \koolreport\datagrid\DataTables;
?>


<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        
      </div>


<?php
       DataTables::create(array(
            "dataStore"=>$this->dataStore("together"),


            "columns"=>array(
              
               "GSTIN Of Supplier"=>array(
                  "label"=>"GSTIN Of Supplier".implode(',',$this->params["gstin_uin_of_supplier"])
              ),
              
              "Document Type"=>array(
                "label"=>"Document Type".implode(',',$this->params["doc_type"])
            ),
            
            "GSTIN Of Customer"=>array(
              
              "label"=>"GSTIN Of Customer"
            ),
           
          "Customer Name"=>array(
                  "label"=>"Customer Name"
              ),
              "Invoice No"=>array(
                "label"=>"Invoice No"
            ),
            

            "Invoice Date"=>array(
              "label"=>"Invoice Date"
          ),



          "Invoice Category"=>array(
            "label"=>"Invoice Category".implode(',',$this->params["category"])
            ),

        "Item Name"=>array(
          "label"=>"Item Name"
         ),
     

       "Quantity"=>array(
      "label"=>"Quantity"
      ),
      "Item Rate "=>array(
        "label"=>"Item Rate "
        ),
        "Taxable Amount"=>array(
          "label"=>"Taxable Amount"
        ),
        "SGST Rate"=>array(
          "label"=>"SGST Rate"
        ),
        "SGST amount"=>array(
          "label"=>"SGST amount"
        ),
        "CGST Rate"=>array(
          "label"=>"CGST Rate"
        ),

        "GSTamount"=>array(
          "label"=>"GSTamount"
        ),
        "IGST Rate"=>array(
          "label"=>"IGST Rate"
        ),
        "IGST amount"=>array(
          "label"=>"IGST amount"
        ),
        "CGST Rate"=>array(
          "label"=>"CGST Rate"
        ),
        "CESS Amount"=>array(
          "label"=>"CESS Amount"
        ),

        "Diff Percent"=>array(
          "label"=>"Diff Percent"
        ),
        "Total Tax Amount"=>array(
          "label"=>"Total Tax Amount"
        ),
        "Gross Total Amount"=>array(
          "label"=>"Gross Total Amount"
        ),
        "Place Of Supply"=>array(
          "label"=>"Place Of Supply"
        ),
        "FP"=>array(
          "label"=>"FP".$this->params["fp"]
        ),
        "Uploaded Status"=>array(
          "label"=>"Uploaded Status".implode(',',$this->params["salestatus"])
        ),
        "Table No"=>array(
          "label"=>"Table No"
        ),
        "MaxDate"=>array(
          "label"=>"MaxDate"
        ),

        ),
            "options"=>array(
              "paging"=>true,
              //"pageLength" => 50
              "lengthMenu" => [50, 100, 150, 200]
          ),
          
          "cssClass"=>array(
            "table"=>"table table-hover table-bordered"
        )


        ));
        ?>

</div>



          





















