<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\favouriteauthor;
use App\Author;
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
    
        
        
        
            $author_id = $request['author_id'];
       
           


        $favorite =favouriteauthor::where('author_id', $author_id)
        ->where('user_id', Auth::user()->id)
        ->first();
        if(!$favorite ){
            $newfav = new favouriteauthor;
            $newfav->author_id =$author_id; 
            $newfav->user_id = Auth::user()->id;
            
            $newfav->save();
             
        }
        
            else
            {
            favouriteauthor::where('author_id', $author_id)
        ->where('user_id', Auth::user()->id)
        ->delete();
        
        }
        return response()->json(['message'=>'successfully']); 
      
    

    }








    public function get()
    {

     
    return view('favouriteauthorlist');  
        
    }



    public function readfav()
    {
        $query= favouriteauthor::where('user_id', Auth::user()->id) 
        ->join('authors', 'authors.id', '=', 'favouriteauthors.author_id')
        ->select('authors.authorname')->get();
        return view('favauthorlistbyuser', compact('query')); 
       // return response()->json($query);  
    }
}
