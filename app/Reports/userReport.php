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
        ->query("SELECT name ,email , gender,DATE_FORMAT(dob,'%d-%b-%Y') AS DOB,case when user_status = 1 then 'active'  when user_status = 2 then 'Activation Pending' else  'Deactive' end user_status   FROM users")
        
        
        ->pipe($this->dataStore('users'));

       
    }
}
  