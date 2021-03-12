<?php

namespace App\Imports;


use App\salereg;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class gstImport implements ToModel,WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new salereg([
            'gstin_uin_of_supplier'=> $row['0'],
                     'doc_type' => $row['1'],
                     ' gstin_of_customer' => $row['2'],
                     'ecom_gstin' => $row['3'],
                     'customer_name' => $row['4'],
                     'invoice_no' => $row['5'],
                     'invoice_date' => $row['6'],
                     'invoice_category' => $row['7'],
                     'item_name' => $row['8'],
                     'hsn_sac_code' => $row['9'],
                     ' uom' => $row['10'],
                     'quantity' => $row['11'],
                     'item_rate' => $row['12'],
                     'taxable_amt' => $row['13'],
                     'sgst_rate' => $row['14'],
                     'sgst_amt' => $row['15'],
                     'cgst_rate' => $row['16'],
                     'cgst_amt' => $row['17'],
                     'igst_rate' => $row['18'],
                     'igst_amt' => $row['19'],
                     'cess_rate' => $row['20'],
                     'cess_amount' => $row['21'],
                     'diff_percent' => $row['22'],
                     'total_tax_amount' => $row['23'],
                     'gross_total_amount' => $row['24'],
                     'nilrated_amt' => $row['25'],
                     'exempted_amt' => $row['26'],
                     'non_gst_amt' => $row['27'],
                     'place_of_supply' => $row['28'],
                     'reverse_charge' => $row['29'],
                     'exp_Type' => $row['30'],
                     'port' => $row['31'],
                     'shipping_bill_no' => $row['32'],
                     'shipping_bill_date' => $row['33'],
                     'debit_gl_id' => $row['34'],
                     'debit_gl_name' => $row['35'],
                     'credit_gl_id' => $row['36'],
                     'credit_gl_name' => $row['37'],
                     'cfs' => $row['38'],
                     'updby' => $row['39'],
                     'fp' => $row['40'],
                     'gt' => $row['41'],
                     ' curr_gt' => $row['42'],
                     'trans_id' => $row['43'],
                     'ref_id' => $row['44'],
                     'uploaded_status' => $row['45'],
                     'flag' => $row['46'],
                     'UsrId' => $row['47'],
                     'table_no' => $row['48'],
                     'supply_type' => $row['49'],
                     'batch_no' => $row['50'],
                     'gstin_check_supp' => $row['51'],
                     'gstin_check_customer' => $row['52'],
                     'date_validate' => $row['53'],
                     'numeric_validate' => $row['54'],
                     'message' => $row['55'],
                     'errorDesciption' => $row['56'],
                     'row_version' => $row['57'],
                     ' reco_tran_id' => $row['58'],
                     'timestamp' => $row['59'],
                     'status_cd' => $row['60'],
                     'gstr3b_status' => $row['61'],
                     'savebatch_no' => $row['62'],
                     'isRemoved' => $row['63'],
                     'removedBy' => $row['64'],

                     


            
                     
        ]);
    }



    public function startRow(): int 
    {
         return 1;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
                     {
                         return 1000;
                     }


}