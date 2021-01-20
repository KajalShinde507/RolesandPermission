<?php
namespace App\Reports;
use \koolreport\processes\Join;
use \koolreport\querybuilder\DB;


class userReport extends \koolreport\KoolReport
{
   
    use \koolreport\laravel\Friendship;
   
   use \koolreport\export\Exportable;
    use \koolreport\excel\ExcelExportable;
    public function setup()
    {
        $this->src('mysql')
        ->query("SELECT name,email FROM users")
        
        
        ->pipe($this->dataStore('users'));

       
    }
}
  