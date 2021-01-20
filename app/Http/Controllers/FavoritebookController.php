<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\favouritebook;

class FavoritebookController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        
       
    }



 
 public function store(Request $request)
    {
        abort_unless(\Gate::allows('isUser'), 403);
       $request->validate([
            
            'user_id'=>'required',
            'book_id'=>'required',
        ]);
    
        
        
        $favorite= new favouritebook ([
            'user_id' => $request->get('user_id'),
            'book_id' => $request->get('book_id'),
            
        
        
        ]);
        $favorite->save();
        
        return redirect()->back();
    

    }

   public function destroy($book_id)
   {
    abort_unless(\Gate::allows('isUser'), 403);
        $favorite = favouritebook::findOrFail($book_id);
        $favorite-> delete();

        return redirect()->back();
    }
    

}
