<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\salereg;
use App\Imports\salergimport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

class Sale_rgJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $import, $file;
    

    public function __construct($import, $file)
    {   
        $this->import=$import;
        $this->file=$file;
      
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //dd($this->import, $this->file);
        Excel::import($this->import, $this->file);
        /*if(isset($this->file) && !empty($this->file))
        {
            foreach($this->file as $val)
            {
                salereg::insert($val);
            }
        }*/
    }
}
