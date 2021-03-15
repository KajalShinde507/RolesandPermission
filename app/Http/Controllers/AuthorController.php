<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Book;
use App\Author;
use App\favouriteauthor;
use User;
use Illuminate\Support\Facades\Auth;
use DB;
use Excel;
use App\Imports\AuthorsImport;

use App\Exports\AuthorsExport;
use App\Reports\authorReport;
class AuthorController extends Controller
{
    


    public function __construct()
    {
       $this->middleware('auth');
      
    }

    public function authorreport()
    { 
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new authorReport;
        $report->run();
        return view("Reports.authorreport",["report"=>$report]);
    }
    
    public function authorkoolexport()
    {
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new authorReport;

        $report->run();
      $report->exportToExcel('authorReportExcel')->toBrowser("authorReport.xlsx");
    }

   



    public function readauthor()
    {  
        
        if(Auth::user()->role ==config('roles.Front User'))
        {
            $data= Author::get();
        }
        else{
         
          $data= Author::withTrashed()->get();
        }
         return response()->json($data); 
       
    }

    public function importExportView()
      {
        abort_unless(\Gate::allows('isAdmin'), 403);
         $book= Book::all();
          return view('sub.import',compact('book'));
          
      }
 
 
  public function import(Request $request)
  {
    abort_unless(\Gate::allows('isAdmin'), 403);
    $this->validate($request,
    [
       'file'=> 'required|mimes:xls,xlsx,csv'
       ]);
           Excel::import(new authorsImport,request()->file('file'));
           return redirect()->back()->with('success',' Author excel File Imported');
  }


  public function export(Request $request) 
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
         if ($request->input('exportexcel') != null ){
                 return Excel::download(new AuthorsExport, 'Authorexport.xlsx');
              }
         
              if ($request->input('exportcsv') != null ){
                 return Excel::download(new AuthorsExport, 'Authorexport.csv');
              }
         
              return redirect()->back();
    }

    
   
     public function index()
    {
        $author= Author::paginate(4);
       return view('sub.index', compact('author'));
    }

    

    
    public function create()
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
        return view('sub.create');
    }

    
    public function store(Request $request)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
        $request->validate([
            
            'authorname'=>'required',
            'email'=>'required',
            
            
        ]);
    
        
    
        $author=new Author([
            'authorname' => $request->get('authorname'),
            'email' => $request->get('email'),
            
            
        
        
        ]);
        $author->save();
        
        return redirect('sub');
    }

    
    public function edit($id)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
        $author = Author::find($id);
        return view('sub.edit', compact('author'));    
    }

    
    public function update(Request $request, $id)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
        $request->validate([
            'authorname'=>'required',
            'email'=>'required',
            
        ]);

        $author = Author::find($id);
        $author->authorname=  $request->get('authorname');
        $author->email = $request->get('email');
        
        
        $author->save();

        
        return redirect('sub');
    }

   
    public function destroy($id)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
        $author = Author::find($id);

        if ($author)  {
            if ($author->delete()){
    
            DB::statement('ALTER TABLE authors AUTO_INCREMENT = '.(count(Author::all())+1).';');
            }
            return redirect('sub');
        }
    }


    public function softstore(Request $request)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
       
            
       $id = $request['id'];
       
           


        $favorite =Author::where('id', $id)
        
        ->first();
        if(!$favorite ){


        Author::where('id', $id)->restore();
                
            return response()->json(['message'=> "Recover Author Data"]); 
            //Book::where('id', $id)

           
             
        }
        
            else
            {
             
                

                $book = Author::find($id);

                if ($book)  {
                    if ($book->delete()){
            
                    DB::statement('ALTER TABLE authors AUTO_INCREMENT = '.(count(Author::all())+1).';');
                    }
                }
               // ->delete();
                return response()->json(['message'=> "Deleted Author Data"]);
               
            }
                //return response()->json($newfav); 
        //return response()->json(['message'=>'successfully']); 
       
    

    }









}
