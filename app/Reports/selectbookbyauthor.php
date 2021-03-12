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
use \koolreport\querybuilder\MySQL;

class selectbookbyauthor extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;

    use \koolreport\export\Exportable;
    use \koolreport\excel\ExcelExportable;
  

   
    use \koolreport\inputs\Bindable;
    use \koolreport\inputs\POSTBinding;

    protected function defaultParamValues()
    {
        return array(
            
            "author"=>NULL,
            
        );
    }
    
    protected function bindParamsToInputs()
    {
        return array(
            
            "author",
            
        );
    }

   
    
    

    public function setup()
    {
     
    $this->src("mysql")->query("
        SELECT authorname, author,email from authors
    ")->pipe($this->dataStore("authors"));

    if($this->params["author"]!=NULL)
   {
        $this->src("mysql")->query("
        SELECT
        books.bookname,
        authors.authorname,
        authors.author,
        books.author,
        books.price
        
        FROM books
        JOIN authors
         ON
        authors.author = books.author       
        WHERE books.author= :author 
        

    
        ")
        ->params(array(
            ":author"=>$this->params["author"],
        ))
        ->pipe($this->dataStore("together"));            
    }

    else{





        $this->src("mysql")->query("
        select books.bookname, authors.authorname,books.price,case when books.deleted_at is null then 'active' else  'archive' end status from books join authors on authors.author = books.author; 
        

    
        ")
        
        ->pipe($this->dataStore("together"));      

        }

  }
}
  