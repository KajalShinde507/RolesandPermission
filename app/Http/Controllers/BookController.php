<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationRequired;
use App\Book;
use App\User;
use App\Mail\SendEmail;
use App\Jobs\SendEmailJob;
use App\Jobs\Sale_rgJob;
use Mail;
use Illuminate\Support\Facades\Auth;
use App\Author;
use DB;
use Excel;
use Carbon\Carbon;
use App\favouritebook;
use App\Exports\BooksExport;
use App\Imports\booksImport;
use App\Imports\gstImport;
use App\Imports\salergimport;
use App\Reports\MyReport;
use App\Reports\bookselectReport;
use App\Reports\selectbookbyauthor;
use App\Reports\mostfavbookReport;

class BookController extends Controller
{
   
   public function __construct()
    {
        $this->middleware('auth');
        
       
    }


    public function sample()
    {
        $value=config('status.activation_pending');
        return response()->json($value); 
        
    }


    

    public function bookreport()
    {
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new MyReport;
        $report->run();
        return view("Reports.bookreport",["report"=>$report]);
    }



    public function bookselectreport()
    {
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new bookselectReport;
        $report->run();
        return view("Reports.bookselectreport",["report"=>$report]);
    }
    public function selectbookbyauthor(Request $request)
    {
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new selectbookbyauthor;
        $report->run();
        return view("Reports.bookselectreport",["report"=>$report]);
    }

    public function bookbyauthorexport(Request $request)
    {
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new selectbookbyauthor;
        $report->run();
        $report->exportToExcel('selectbookbyauthorExcel')->toBrowser("selectbookbyauthor.xlsx");
    }


    public function bookkoolexport()
    {
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new MyReport;

        $report->run();
      $report->exportToExcel('MyReportExcel')->toBrowser("MyReport.xlsx");


      
     
    }


    public function favreport()
    {
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new mostfavbookReport;
        $report->run();

        return view("Reports.favreport",["report"=>$report]);


    }
    public function favkoolexport()
    {
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new mostfavbookReport;
        $report->run();

        $report->exportToExcel('mostfavbookReportExcel')->toBrowser("mostfavbookReport.xlsx");
    }

   public function import(Request $request)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
       
         $this->validate($request,
      [
       'file'=> 'required|mimes:xls,xlsx,csv'
       ]);

       Excel::import(new booksImport,request()->file('file'));
             return redirect()->back()->with('success',' import excel File Uploaded');
      }


      public function importsale(Request $request)
      {
          abort_unless(\Gate::allows('isAdmin'), 403);
         
         
         $this->validate($request,[
            'import_file' => 'required|mimes:xls,xlsx,csv',
        ]);
  
        Excel::import(new gstImport,request()->file('import_file'));
         
    
              return response()->json(['message'=>'your file will process please wait']); 
        }
  

      public function  importViewsalereport(Request $request)
      {
           abort_unless(\Gate::allows('isAdmin'), 403);
             $this->validate($request,[
            'import_file' => 'required|mimes:xls,xlsx,csv',
             ]);
             

             $nowtime = Carbon::now()->format('Y-m-d H:i:s');
           
             //dd($nowtime);
           if(request()->file('import_file')) {
                $import = new salergimport( $nowtime);
                $path = request()->file('import_file');
                $filename=time().'.'.$path->getClientOriginalExtension();
                $file  = $path->storeAs('Upload', $filename);
                 //dd($file);
                Sale_rgJob::dispatch($import, $file);
        
            }
      
        return response()->json(['message'=>'your file will process please wait']);
        
      
     
    }
      
      public function importExportViewsalereport()
     {
       abort_unless(\Gate::allows('isAdmin'), 403);
        return view('main.saleimportreport');
       
         
     }
  
      

  public function importgst(Request $request)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
       
         $this->validate($request,
      [
       'file'=> 'required|mimes:xls,xlsx,csv'
       ]);

       Excel::import(new gstImport,request()->file('file'));
             return redirect()->back()->with('success',' import excel File Uploaded');
      }

  


   public function export(Request $request) 
  {
    abort_unless(\Gate::allows('isAdmin'), 403);
       if ($request->input('exportexcel') != null ){
                  return Excel::download(new BooksExport, 'Bookexport.xlsx');
       }

             if ($request->input('exportcsv') != null ){
                   return Excel::download(new BooksExport, 'Bookexport.csv');
       }

     return redirect()->back();
   }
    
public function mailsent(Request $request)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
         $book= Book::select('bookname')            
        ->orderBy('price', 'desc')   
        ->take(5)                
        ->get();
        if(Auth::user()->isAdmin())
            {
            
            SendEmailJob::dispatch($book);
            
            Mail::to($request->user())->send(new SendEmail($book));
    
        
           return redirect()->back()->with('success',' mail sent successfully');
    
        }


       
    }
    
    
     public function sentpost(Request $request)
     { 
        abort_unless(\Gate::allows('isAdmin'), 403);
       
        $book= Book::select('bookname')            
        ->orderBy('price', 'desc')   
        ->take(5)                
        ->get();
        $admins = User::where('role', 1)->get();
        Mail::to($admins)->send(new SendEmail($book));

        //Mail::to('kajalshinde507@gmail.com')->send(new SendEmail($book));
        return redirect()->back()->with('success',' mail sent successfully');
       
     }


     public function show1()
     {
        abort_unless(\Gate::allows('isAdmin'), 403);
        
        $books= Book::get();
    
         return view('bookList',['books'=> $books]); 
       }
     public function importExportView()
      {
        abort_unless(\Gate::allows('isAdmin'), 403);
        $book= Book::all();
          return view('main.import',compact('book'));
          
      }
      public function importExportViewsale()
      {
        abort_unless(\Gate::allows('isAdmin'), 403);
        

        return view('main.saleimport');
        
          
      }
   
      public function read()
        {  
            if(Auth::user()->role =='3')
            {
                $data= Book::get();  
            }
        else{
        $data= Book::withTrashed()->get();
            }
        return response()->json($data); 
        }
      public function index()
     {
     
        return view('main.index');
     
      }

   
    
    public function create()
    {  
        abort_unless(\Gate::allows('isAdmin'), 403);
        return view('main.create');
    }

   
    public function store(Request $request)
     {
        abort_unless(\Gate::allows('isAdmin'), 403);
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
        return redirect('main');
    }

    

   
    public function edit($id)
    {   abort_unless(\Gate::allows('isAdmin'), 403);
        $book = Book::find($id);
        return view('main.edit', compact('book'));   
    }
  
    public function update(Request $request, $id)
    {         abort_unless(\Gate::allows('isAdmin'), 403);
        $validatedData = $request->validate([
            'bookname'=>'required',
            'author'=>'required',
            'price'=>'required'
        ]);
        
        $book = Book::find($id);
        $book->bookname=  $request->get('bookname');
        $book->author = $request->get('author');
        $book->price = $request->get('price');
        $book->save();
        return redirect('/main');
        
    }

    

   public function destroy($id)
    {

        abort_unless(\Gate::allows('isAdmin'), 403);
        $book = Book::find($id);

        if ($book)  {
            if ($book->delete()){
    
            DB::statement('ALTER TABLE books AUTO_INCREMENT = '.(count(BOOK::all())+1).';');
            }
         return redirect('main');
        }
    }


    public function softstore(Request $request)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);
       
            
            
       
    
        
        
        
            $id = $request['id'];
       
           


        $favorite =Book::where('id', $id)
        
        ->first();
        if(!$favorite ){


        Book::where('id', $id)->restore();
                
            return response()->json(['message'=> "Recover Books Data"]); 
            //Book::where('id', $id)

           
             
        }
        
            else
            {
             
                

                $book = Book::find($id);

                if ($book)  {
                    if ($book->delete()){
            
                    DB::statement('ALTER TABLE books AUTO_INCREMENT = '.(count(BOOK::all())+1).';');
                    }
                }
               // ->delete();
                return response()->json(['message'=> "Deleted Books Data"]);
               
            }
                //return response()->json($newfav); 
        //return response()->json(['message'=>'successfully']); 
       
    

    }





}

