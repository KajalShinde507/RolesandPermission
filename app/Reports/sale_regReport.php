<?php
namespace App\Reports;
use \koolreport\processes\Join;
use \koolreport\querybuilder\DB;
use \koolreport\processes\Map;
use \koolreport\processes\Limit;
use \koolreport\processes\Filter;
use \koolreport\cube\processes\Cube;
use \koolreport\core\Utility;
use \koolreport\pivot\processes\Pivot;
use \koolreport\processes\AggregatedColumn;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\ColumnRename;
class sale_regReport extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;
    
    use \koolreport\export\Exportable;
    use \koolreport\excel\ExcelExportable;
    use \koolreport\inputs\Bindable;
    use \koolreport\inputs\POSTBinding;
  
   function defaultParamValues()
    {
        return array(
            "gstin_uin_of_supplier"=>array(),
            "fp"=>NULL,
            "doc_type"=>array(),
            "salestatus"=>array(),
            "category"=>array(),
            "summary"=>array(),
            

        );
    }

    function bindParamsToInputs()
    {
        return array(
            
            "gstin_uin_of_supplier",
            "fp",
            "doc_type",
            "salestatus",
            "category",
            "summary"
            
        );
    }

    public function setup()
    {
        //dd($this->params["gstin_uin_of_supplier"],$this->params["fp"], $this->params["doc_type"], $this->params);
       
        
        if($this->params["summary"]=='Line-level')
        {
             $sql = "SELECT final_outward_sales_reg.gstin_uin_of_supplier, final_outward_sales_reg.doc_type, final_outward_sales_reg.gstin_of_customer, final_outward_sales_reg.ecom_gstin, final_outward_sales_reg.customer_name, final_outward_sales_reg.invoice_no, final_outward_sales_reg.invoice_date, final_outward_sales_reg.invoice_category, final_outward_sales_reg.item_name,  final_outward_sales_reg.quantity, final_outward_sales_reg.item_rate, final_outward_sales_reg.taxable_amt, final_outward_sales_reg.sgst_rate, final_outward_sales_reg.sgst_amt, final_outward_sales_reg.cgst_rate, final_outward_sales_reg.cgst_amt, final_outward_sales_reg.igst_rate, final_outward_sales_reg.igst_amt, final_outward_sales_reg.cess_rate, final_outward_sales_reg.cess_amount, final_outward_sales_reg.diff_percent, final_outward_sales_reg.total_tax_amount, final_outward_sales_reg.gross_total_amount, final_outward_sales_reg.place_of_supply, final_outward_sales_reg.fp, sm_pickup_master.ref_short_desc  as uploaded_status, final_outward_sales_reg.table_no,uploaded_status, final_outward_sales_reg.row_version  FROM final_outward_sales_reg   join sm_pickup_master on final_outward_sales_reg.uploaded_status = sm_pickup_master.ref_code 
               WHERE  final_outward_sales_reg.gstin_uin_of_supplier IN (:gstin_uin_of_supplier) AND final_outward_sales_reg.fp = :fp";
            
             $query_params = [":gstin_uin_of_supplier" =>$this->params["gstin_uin_of_supplier"], ":fp" => $this->params["fp"]];
        
            if($this->params["salestatus"]!=array()){
                $sql .= " AND final_outward_sales_reg.uploaded_status IN(:salestatus)";
                $query_params[":salestatus"] = $this->params["salestatus"];
            }
            
         if($this->params["doc_type"]!=array())
         {
            $sql .= " AND final_outward_sales_reg.doc_type IN(:doc_type)";
            $query_params[":doc_type"] = $this->params["doc_type"];
         }
          if($this->params["category"]!=array())
         {
             $sql .= " AND final_outward_sales_reg.invoice_category IN(:category)";
             $query_params[":category"] = $this->params["category"];
         }
        
         $sql .= "AND final_outward_sales_reg.row_version = ( SELECT  MAX(aa.row_version) FROM final_outward_sales_reg aa  WHERE  final_outward_sales_reg.gstin_uin_of_supplier  = aa.gstin_uin_of_supplier  AND final_outward_sales_reg.fp = aa.fp AND final_outward_sales_reg.doc_type = aa.doc_type  AND final_outward_sales_reg.invoice_category = aa.invoice_category  group by aa.gstin_uin_of_supplier,aa.gstin_of_customer, aa.invoice_category,aa.invoice_no  having  final_outward_sales_reg.invoice_no = aa.invoice_no AND final_outward_sales_reg.gstin_of_customer= aa.gstin_of_customer ) " ;
        // dd($sql);
         $this->src("mysql")->query($sql)->params($query_params)->pipe(new ColumnRename(array(
            "gstin_uin_of_supplier"=>"GSTIN Of Supplier",
             "doc_type"=>"Document Type",
            "gstin_of_customer"=>"GSTIN Of Customer",
            "customer_name"=>"Customer Name",
            "invoice_no"=>"Invoice No",
            "invoice_date"=>"Invoice Date",
            "invoice_category"=>"Invoice Category",
            "item_name"=>"Item Name",
            "quantity"=>"Quantity",
            "item_rate"=>"Item Rate ",
            "taxable_amt"=>"Taxable Amount",
            "sgst_rate"=>"SGST Rate",
            "sgst_amt"=>"SGST amount",
            "cgst_rate"=>"CGST Rate",
            "cgst_amt"=>"GSTamount",
            "igst_rate"=>"IGST Rate",
            "igst_amt"=>"IGST amount",
            "cess_rate"=>"CGST Rate",
            "cess_amount"=>"CESS Amount",
            "diff_percent"=>"Diff Percent",
            "total_tax_amount"=>"Total Tax Amount",
            "gross_total_amount"=>"Gross Total Amount",
            "place_of_supply"=>"Place Of Supply",
            "fp"=>"FP",
            "uploaded_status"=>"Uploaded Status",
            "table_no"=>"Table No",
            "row_version"=>"MaxDate"
    
        )))->pipe($this->dataStore("together"));
        
        
        
        }




        else if($this->params["summary"]=='Invoice-level')
        { 
            //dd($this->params);
             $sql = "SELECT final_outward_sales_reg.gstin_uin_of_supplier, final_outward_sales_reg.doc_type, final_outward_sales_reg.gstin_of_customer, final_outward_sales_reg.ecom_gstin, final_outward_sales_reg.customer_name, final_outward_sales_reg.invoice_no, final_outward_sales_reg.invoice_date, final_outward_sales_reg.invoice_category, final_outward_sales_reg.item_name,  final_outward_sales_reg.quantity, final_outward_sales_reg.item_rate, SUM(final_outward_sales_reg.taxable_amt) AS taxable_amt, final_outward_sales_reg.sgst_rate, SUM(final_outward_sales_reg.sgst_amt) AS sgst_amt , final_outward_sales_reg.cgst_rate, SUM(final_outward_sales_reg.cgst_amt)AS cgst_amt, final_outward_sales_reg.igst_rate, SUM(final_outward_sales_reg.igst_amt) AS igst_amt, final_outward_sales_reg.cess_rate, SUM(final_outward_sales_reg.cess_amount)AS cess_amount, final_outward_sales_reg.diff_percent, SUM(final_outward_sales_reg.total_tax_amount)AS total_tax_amount, SUM(final_outward_sales_reg.gross_total_amount)AS gross_total_amount, final_outward_sales_reg.place_of_supply, final_outward_sales_reg.fp, sm_pickup_master.ref_short_desc  as uploaded_status, final_outward_sales_reg.table_no , final_outward_sales_reg.row_version FROM final_outward_sales_reg  join sm_pickup_master on final_outward_sales_reg.uploaded_status = sm_pickup_master.ref_code  WHERE  final_outward_sales_reg.gstin_uin_of_supplier IN (:gstin_uin_of_supplier)   AND final_outward_sales_reg.fp = :fp ";
            
             $query_params = [":gstin_uin_of_supplier" =>$this->params["gstin_uin_of_supplier"], ":fp" => $this->params["fp"]];
        
            if($this->params["salestatus"]!=array()){
                $sql .= " AND final_outward_sales_reg.uploaded_status IN(:salestatus)";
                $query_params[":salestatus"] = $this->params["salestatus"];
            }
            
          if($this->params["doc_type"]!=array())
         {
            $sql .= " AND final_outward_sales_reg.doc_type IN(:doc_type)";
            $query_params[":doc_type"] = $this->params["doc_type"];
         }
          if($this->params["category"]!=array())
         {
             $sql .= " AND final_outward_sales_reg.invoice_category IN(:category)";
             $query_params[":category"] = $this->params["category"];
         }

         $sql .= "AND final_outward_sales_reg.row_version = ( SELECT  MAX(aa.row_version) FROM final_outward_sales_reg aa  WHERE  final_outward_sales_reg.gstin_uin_of_supplier  = aa.gstin_uin_of_supplier  AND final_outward_sales_reg.fp = aa.fp AND final_outward_sales_reg.doc_type = aa.doc_type  AND final_outward_sales_reg.invoice_category = aa.invoice_category group by aa.invoice_no,aa.gstin_uin_of_supplier,aa.doc_type, aa.gstin_of_customer,aa.invoice_category having  final_outward_sales_reg.invoice_no = aa.invoice_no AND final_outward_sales_reg.gstin_of_customer= aa.gstin_of_customer )GROUP BY invoice_no " ;
        //dd($sql);
         $this->src("mysql")->query($sql)->params($query_params)->pipe(new ColumnRename(array(
            "gstin_uin_of_supplier"=>"GSTIN Of Supplier",
             "doc_type"=>"Document Type",
            "gstin_of_customer"=>"GSTIN Of Customer",
            "customer_name"=>"Customer Name",
            "invoice_no"=>"Invoice No",
            "invoice_date"=>"Invoice Date",
            "invoice_category"=>"Invoice Category",
            "item_name"=>"Item Name",
            "quantity"=>"Quantity",
            "item_rate"=>"Item Rate ",
            "taxable_amt"=>"Taxable Amount",
            "sgst_rate"=>"SGST Rate",
            "sgst_amt"=>"SGST amount",
            "cgst_rate"=>"CGST Rate",
            "cgst_amt"=>"GSTamount",
            "igst_rate"=>"IGST Rate",
            "igst_amt"=>"IGST amount",
            "cess_rate"=>"CGST Rate",
            "cess_amount"=>"CESS Amount",
            "diff_percent"=>"Diff Percent",
            "total_tax_amount"=>"Total Tax Amount",
            "gross_total_amount"=>"Gross Total Amount",
            "place_of_supply"=>"Place Of Supply",
            "fp"=>"FP",
            "uploaded_status"=>"Uploaded Status",
            "table_no"=>"Table No",
            "row_version"=>"MaxDate"
            
    
        )))->pipe($this->dataStore("together"));
        
        
        
        }


       else
       {

        $sql = "SELECT final_outward_sales_reg.gstin_uin_of_supplier, final_outward_sales_reg.doc_type, final_outward_sales_reg.gstin_of_customer, final_outward_sales_reg.ecom_gstin, final_outward_sales_reg.customer_name, final_outward_sales_reg.invoice_no, final_outward_sales_reg.invoice_date, final_outward_sales_reg.invoice_category, final_outward_sales_reg.item_name,  final_outward_sales_reg.quantity, final_outward_sales_reg.item_rate, final_outward_sales_reg.taxable_amt, final_outward_sales_reg.sgst_rate, final_outward_sales_reg.sgst_amt, final_outward_sales_reg.cgst_rate, final_outward_sales_reg.cgst_amt, final_outward_sales_reg.igst_rate, final_outward_sales_reg.igst_amt, final_outward_sales_reg.cess_rate, final_outward_sales_reg.cess_amount, final_outward_sales_reg.diff_percent, final_outward_sales_reg.total_tax_amount, final_outward_sales_reg.gross_total_amount, final_outward_sales_reg.place_of_supply, final_outward_sales_reg.fp, sm_pickup_master.ref_short_desc  as uploaded_status, final_outward_sales_reg.table_no,uploaded_status, final_outward_sales_reg.row_version  FROM final_outward_sales_reg   join sm_pickup_master on final_outward_sales_reg.uploaded_status = sm_pickup_master.ref_code 
        WHERE  final_outward_sales_reg.gstin_uin_of_supplier IN (:gstin_uin_of_supplier) AND final_outward_sales_reg.fp = :fp";
     
      $query_params = [":gstin_uin_of_supplier" =>$this->params["gstin_uin_of_supplier"], ":fp" => $this->params["fp"]];
 
     if($this->params["salestatus"]!=array()){
         $sql .= " AND final_outward_sales_reg.uploaded_status IN(:salestatus)";
         $query_params[":salestatus"] = $this->params["salestatus"];
     }
     
  if($this->params["doc_type"]!=array())
  {
     $sql .= " AND final_outward_sales_reg.doc_type IN(:doc_type)";
     $query_params[":doc_type"] = $this->params["doc_type"];
  }
   if($this->params["category"]!=array())
  {
      $sql .= " AND final_outward_sales_reg.invoice_category IN(:category)";
      $query_params[":category"] = $this->params["category"];
  }
 
  $sql .= "AND final_outward_sales_reg.row_version = ( SELECT  MAX(aa.row_version) FROM final_outward_sales_reg aa  WHERE  final_outward_sales_reg.gstin_uin_of_supplier  = aa.gstin_uin_of_supplier  AND final_outward_sales_reg.fp = aa.fp AND final_outward_sales_reg.doc_type = aa.doc_type  AND final_outward_sales_reg.invoice_category = aa.invoice_category group by aa.invoice_no,aa.gstin_uin_of_supplier,aa.doc_type, aa.invoice_category having  final_outward_sales_reg.invoice_no = aa.invoice_no ) " ;
  //dd($sql);
  $this->src("mysql")->query($sql)->params($query_params)->pipe(new ColumnRename(array(
     "gstin_uin_of_supplier"=>"GSTIN Of Supplier",
      "doc_type"=>"Document Type",
     "gstin_of_customer"=>"GSTIN Of Customer",
     "customer_name"=>"Customer Name",
     "invoice_no"=>"Invoice No",
     "invoice_date"=>"Invoice Date",
     "invoice_category"=>"Invoice Category",
     "item_name"=>"Item Name",
     "quantity"=>"Quantity",
     "item_rate"=>"Item Rate ",
     "taxable_amt"=>"Taxable Amount",
     "sgst_rate"=>"SGST Rate",
     "sgst_amt"=>"SGST amount",
     "cgst_rate"=>"CGST Rate",
     "cgst_amt"=>"GSTamount",
     "igst_rate"=>"IGST Rate",
     "igst_amt"=>"IGST amount",
     "cess_rate"=>"CGST Rate",
     "cess_amount"=>"CESS Amount",
     "diff_percent"=>"Diff Percent",
     "total_tax_amount"=>"Total Tax Amount",
     "gross_total_amount"=>"Gross Total Amount",
     "place_of_supply"=>"Place Of Supply",
     "fp"=>"FP",
     "uploaded_status"=>"Uploaded Status",
     "table_no"=>"Table No",
     "row_version"=>"MaxDate"

 )))->pipe($this->dataStore("together"));
    
   




       }









          

       





       
    }
}
  