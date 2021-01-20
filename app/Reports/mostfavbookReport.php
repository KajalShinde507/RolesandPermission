<?php
namespace App\Reports;
use \koolreport\processes\Join;
use \koolreport\querybuilder\DB;
use \koolreport\processes\Limit;
use \koolreport\processes\Grouping;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\AggregatedColumn;

class mostfavbookReport extends \koolreport\KoolReport
{
   
    use \koolreport\laravel\Friendship;
    
    use \koolreport\export\Exportable;
    use \koolreport\excel\ExcelExportable;
    public function setup()
    {
      


          
        $this->src('mysql')
        ->query("
           select books.bookname, favouritebooks.book_id ,count(favouritebooks.user_id)as cnt from books join favouritebooks  on books.id=favouritebooks.book_id group by book_id order by book_id desc limit 5
            
        ")->pipe($this->dataStore('together'));
       




       
    }
}
  