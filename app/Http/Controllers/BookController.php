<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationRequired;
use App\Book;
use User;
use Illuminate\Support\Facades\Auth;
use App\Author;
use DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('show1');
        
    }
    


    public function show1()
    {
       
        /*if(Auth::user()->isAdmin()==0)
        {
            $books= Book::all();
           
            return view('bookList',['books'=> $books]); 
        }
          return redirect('home');
        */
        $books= Book::paginate(2);
        return view('bookList',['books'=> $books]); 


      
    }
   
    public function index()
    {
       // $book= Book::all();
        $book= Book::paginate(2);
        return view('main.pagination_parent', compact('book'));
       // return view('main.index', compact('book'));
    }
      

    function fetch(Request $request)
    {
     if($request->ajax())
     {
        $book= Book::paginate(2);
      
         return view('main.index', compact('book'))->render();
     }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {

        

        $request->validate([
            
            'bookname'=>'required',
            'author'=>'required',
            'price'=>'required'
        ]);
    
        
    
        $book=new Book([
            'bookname' => $request->get('bookname'),
            'author' => $request->get('author'),
            'price' => $request->get('price'),
        
        
        ]);
        $book->save();
        //return redirect('/api/main');
        return redirect('main');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('main.edit', compact('book'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $request->validate([
            'bookname'=>'required',
            'author'=>'required',
            'price'=>'required'
        ]);

        $book = Book::find($id);
        $book->bookname=  $request->get('bookname');
        $book->author = $request->get('author');
        $book->price = $request->get('price');
        
        $book->save();

        //return redirect('/api/main');
        return redirect('main');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $book = Book::find($id);

        if ($book)  {
            if ($book->delete()){
    
            DB::statement('ALTER TABLE books AUTO_INCREMENT = '.(count(BOOK::all())+1).';');
            }
            
    
           // return redirect('/api/main')->with('$success', 'book deleted!');
            return redirect('main');
        }
    }
    
}

