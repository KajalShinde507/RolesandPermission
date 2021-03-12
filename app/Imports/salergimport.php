<?php

namespace App\Imports;


use App\salereg;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class salergimport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null

    */



    public $nowtime;
    

    public function __construct($nowtime)
    {   
        $this->nowtime=$nowtime;
    
      
    }
    public function model(array $row)
    { 
        //dd($row['exp_type']);
        
        return new salereg([
            
           
            'gstin_uin_of_supplier'=> $row['gstin_uin_of_supplier'],
            'doc_type' => $row['doc_type'],
            'gstin_of_customer' => $row['gstin_of_customer'],
            'ecom_gstin' => $row['ecom_gstin'],
            'customer_name' => $row['customer_name'],
            'invoice_no' => $row['invoice_no'],
            //'invoice_date' => $row['6'],
           'invoice_date' =>Date::excelToDateTimeObject((int)$row['invoice_date'])->format('d-m-Y'),
           //'invoice_date' =>  \Carbon\Carbon::createFromFormat('d-m-Y', $row[6]),
            'invoice_category' => $row['invoice_category'],
            'item_name' => $row['item_name'],
            'hsn_sac_code' => $row['hsn_sac_code'],
            'uom' => $row['uom'],
            'quantity' => $row['quantity'],
            'item_rate' => $row['item_rate'],
            'taxable_amt' => $row['taxable_amt'],
            'sgst_rate' => $row['sgst_rate'],
            'sgst_amt' => $row['sgst_amt'],
            'cgst_rate' => $row['cgst_rate'],
            'cgst_amt' => $row['cgst_amt'],
            'igst_rate' => $row['igst_rate'],
            'igst_amt' => $row['igst_amt'],
            'cess_rate' => $row['cess_rate'],
            'cess_amount' => $row['cess_amount'],
            'diff_percent' => $row['diff_percent'],
            'total_tax_amount' => $row['total_tax_amount'],
            'gross_total_amount' => $row['gross_total_amount'],
            'nilrated_amt' => $row['nilrated_amt'],
            'exempted_amt' => $row['exempted_amt'],
            'non_gst_amt' => $row['non_gst_amt'],
            'place_of_supply' => $row['place_of_supply'],//setColumnFormat(array( 'A' => '@' ))
            'reverse_charge' => $row['reverse_charge'],
            'exp_Type' => $row['exp_type'],
            'port' => $row['port'],
            'shipping_bill_no' => $row['shipping_bill_no'],
            'shipping_bill_date' => $row['shipping_bill_date'],
            'debit_gl_id' => $row['debit_gl_id'],
            'debit_gl_name' => $row['debit_gl_name'],
            'credit_gl_id' => $row['credit_gl_id'],
            'credit_gl_name' => $row['credit_gl_name'],
            'cfs' => $row['cfs'],
            'updby' => $row['updby'],
            'fp' =>$row['fp'],
        
         
            'gt' => $row['gt'],
            'curr_gt' => $row['curr_gt'],
            'trans_id' => $row['trans_id'],
            'ref_id' => $row['ref_id'],
            'uploaded_status' => $row['uploaded_status'],
            'flag' => $row['flag'],
            'UsrId' => $row['usr_id'],
            'table_no' => $row['table_no'],
            'userId' =>$row['userid'],
            'supply_type' => $row['supply_type'],
            'batch_no' => $row['batch_no'],
            'gstin_check_supp' => $row['gstin_check_supp'],
            'gstin_check_customer' => $row['gstin_check_customer'],
            'date_validate' => $row['date_validate'],
            'numeric_validate' => $row['numeric_validate'],
            'message' => $row['message'],
           'errorDesciption' => $row['errordesciption'],
           'row_version'=>$this->nowtime,       
           'reco_tran_id' => $row['reco_tran_id'],
            'timestamp'=>$this->nowtime, 
           'status_cd' => $row['status_cd'],
           'gstr3b_status' => $row['gstr3b_status'],
            'savebatch_no' => $row['savebatch_no'],
            'isRemoved' => $row['isremoved'],
            'removedBy' => $row['removedby'],


]);



     




                     
        
    }






    

}