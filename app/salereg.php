<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salereg extends Model
{
   protected  $table= 'final_outward_sales_reg';

   public $timestamps = false;
  
    protected $fillable = ['gstin_uin_of_supplier', 'doc_type','gstin_of_customer','ecom_gstin','customer_name','invoice_no','invoice_date','invoice_category','item_name','hsn_sac_code','uom','quantity','item_rate','taxable_amt','sgst_rate','sgst_amt','cgst_rate','cgst_amt','igst_rate','igst_amt','cess_rate','cess_amount','diff_percent','total_tax_amount','gross_total_amount','nilrated_amt','exempted_amt','non_gst_amt','place_of_supply','reverse_charge','exp_Type','port','shipping_bill_no','shipping_bill_date','debit_gl_id','debit_gl_name','credit_gl_id','credit_gl_name','cfs','updby','fp','gt','curr_gt','trans_id','ref_id','uploaded_status','flag','UsrId','table_no','userId','supply_type','batch_no','gstin_check_supp','gstin_check_customer','date_validate','numeric_validate','message','errorDesciption','row_version','reco_tran_id','timestamp','status_cd','gstr3b_status','savebatch_no','isRemoved','removedBy'];




}
