<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\favouritebook;
use App\Book;
use Auth;
use DB;
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
    
        
        
        
            $book_id = $request['book_id'];
       
           


        $favorite =favouritebook::where('book_id', $book_id)
        ->where('user_id', Auth::user()->id)
        ->first();
        if(!$favorite ){
            $newfav = new favouritebook;
            $newfav->book_id =$book_id; 
            $newfav->user_id = Auth::user()->id;
            
            $newfav->save();
            return response()->json(['message'=> "Successfully added to favourite list"]); 
            //return response()->json($newfav); 
             
        }
        
            else
            {
            favouritebook::where('book_id', $book_id)
        ->where('user_id', Auth::user()->id)
        ->delete();
        return response()->json(['message'=> "Successfully added to unfavourite list"]);
        }
        //return response()->json(['message'=>'successfully']); 
       
    

    }

   public function destroy($book_id)
   {
    abort_unless(\Gate::allows('isUser'), 403);
        $favorite = favouritebook::findOrFail($book_id);
        $favorite-> delete();

        return redirect()->back();
    }
    public function get()
    {

      /*  $query= favouritebook::where('user_id', Auth::user()->id) 
    ->join('books', 'books.id', '=', 'favouritebooks.id')
    ->select('books.bookname')->get();
    //return response()->json($query); */
    return view('favouritebooklist');  
        // select books.bookname from books join favouritebooks on favouritebooks.book_id= books.id where user_id=3;
    }



    public function readfav()
    {
        $query= favouritebook::where('user_id', Auth::user()->id) 
        ->join('books', 'books.id', '=', 'favouritebooks.book_id')
        ->select('books.bookname')->get();
        //return response()->json($query);
        return view('favbooklistbyuser', compact('query'));   
    }

}
