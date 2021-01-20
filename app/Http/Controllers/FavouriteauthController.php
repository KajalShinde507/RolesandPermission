<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\favouriteauthor;

class FavouriteauthController extends Controller
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
            'author_id'=>'required',
        ]);
    
        
        
        $favorite= new favouriteauthor ([
            'user_id' => $request->get('user_id'),
            'author_id' => $request->get('author_id'),
            
        
        
        ]);
        $favorite->save();
       
        return redirect()->back();
         

    }
}
