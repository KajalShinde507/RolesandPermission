<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class salergExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table();
    }
}
