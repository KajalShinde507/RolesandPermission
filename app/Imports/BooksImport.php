<?php

namespace App\Imports;

use App\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BooksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      
        return new Book([
            'bookname'=> $row['0'],
                     'author' => $row['1'],
                     'price'  => $row['2'],
                     

        ]);
    }
        public function rules(): array
        {
            return [
                '0' => 'required|string',
                '1' => 'required|Integer',
                '3' =>'required|Integer'
            ];
        }


       // return new Book($row);
    
}
