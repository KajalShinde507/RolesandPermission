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
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;
    
    use \koolreport\export\Exportable;
    use \koolreport\excel\ExcelExportable;
  
    

    public function setup()
    {
        
        $this->src('mysql')
        ->query(" select books.bookname, authors.email, books.price, authors.authorname,count(favouritebooks.user_id)as favcount from books join favouritebooks  on books.id=favouritebooks.book_id   join authors on books.author=authors.author group by book_id  order by favcount desc")

           ->pipe($this->dataStore('together'));
      
       
       
    }
}
  