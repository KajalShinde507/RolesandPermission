<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use User;
use Illuminate\Support\Facades\Auth;
use DB;

class AuthorController extends Controller
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
            $authors= Author::all();
        
            return view('authorList',['authors'=> $authors]); 
        }
          return redirect('home');*/


          $authors= Author::paginate(2);
        
            return view('authorList',['authors'=> $authors]); 
    }
    /*public function index()
    {

        


       // $author= Author::all();
       $author= Author::paginate(2);
        return view('sub.index', compact('author'));
    }*/
    function index()
    {
        $author= Author::paginate(2);
     
        return view('sub.pagination_parent', compact('author'));
       // return view('sub.index', compact('author'));
    }

    function fetch(Request $request)
    {
     if($request->ajax())
     {
        $author= Author::paginate(2);
      
         return view('sub.index', compact('author'))->render();
     }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sub.create');
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
            
            'authorname'=>'required',
            'email'=>'required',
            
        ]);
    
        
    
        $author=new Author([
            'authorname' => $request->get('authorname'),
            'email' => $request->get('email'),
            
        
        
        ]);
        $author->save();
        //return redirect('/api/sub');
        return redirect('sub');
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
        $author = Author::find($id);
        return view('sub.edit', compact('author'));   
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
            
            'authorname'=>'required',
            'email'=>'required',
            
        ]);

        $author = Author::find($id);
        $author->authorname=  $request->get('authorname');
        $author->email = $request->get('email');
        
        
        $author->save();

        //return redirect('/api/sub');
        return redirect('sub');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);

        if ($author)  {
            if ($author->delete()){
    
            DB::statement('ALTER TABLE authors AUTO_INCREMENT = '.(count(Author::all())+1).';');
            }
            
    
           // return redirect('/api/main')->with('$success', 'book deleted!');
            return redirect('sub');
        }
    }
}
