<?php
namespace App\Reports;
use \koolreport\processes\Join;
use \koolreport\querybuilder\DB;
use \koolreport\processes\Limit;
use \koolreport\processes\Grouping;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\AggregatedColumn;

class authorReport extends \koolreport\KoolReport
{
   
    use \koolreport\laravel\Friendship;
    
    use \koolreport\export\Exportable;
    use \koolreport\excel\ExcelExportable;
    public function setup()
    {
      
        $this->src('mysql')
        ->query("
        select  authors.authorname ,authors.email ,count(authors.authorname) as book_written, case when authors.deleted_at is null then 'active' else  'archive' end status 
        
         from authors join books on authors.author=books.author group by  authors.author order by book_written desc
            
        ")->pipe($this->dataStore('together'));
        }
}
  