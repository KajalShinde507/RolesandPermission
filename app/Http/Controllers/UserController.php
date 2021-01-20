<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;
use Spatie\Permission\Models\Role;


use App\Reports\userReport;
class UserController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        
       
    }



    public function userreport()
    {
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new userReport;
        $report->run();
        return view("Reports.userreport",["report"=>$report]);
    }
    
   public function read()
   {  
      abort_unless(\Gate::allows('isAdmin'), 403);
       $data= User::where('id','<>',Auth::user()->role)
        ->orWhere('role',2)
        ->get();
        
        
       return response()->json($data); 
    }

      public function userkoolexport()
      {
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new userReport;

        $report->run();
      $report->exportToExcel('userReportExcel')->toBrowser("userReport.xlsx");

      }


    public function index(Request $request)
    {  
           abort_unless(\Gate::allows('isAdmin'), 403);
        $user= User::where('role',1)
              ->orWhere('role',2)
              ->get();
              
        return view('users.index', compact('user'));
        
    }

    
    public function create(Request $request)
    {  
        abort_unless(\Gate::allows('isAdmin'), 403);
         if($request->ajax()){
        $roles = Role::where('id', $request->role_id)->first();
        
    }

    $roles = Role::all();
        return view('users.create',compact('roles'));
    }

   
    protected function validator(array $data)
    {
       return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'=>['required','string'],
        ]);
    }

    protected function store(Request $request)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);



       $user= User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => $request['role'],
        ]);

        $user->save();
        
      return redirect('users');
    }
   

    
    
    
    public function editUser(Request $request)
    {
        abort_unless(\Gate::allows('isUser'), 403);
        return view('users.edituser')->with('user', Auth::user());
    }





    public function updateuser(Request $request, $id)
    {
        abort_unless(\Gate::allows('isUser'), 403);

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            
        ]);

        
      
        $user = User::find($id);
        $user->name=  $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request['password']);
        
        $user->save();
         return redirect()->back()->with('success',' User profile Update successfully');;
     }



    
   

    public function edit($id)
    {   abort_unless(\Gate::allows('isAdmin'), 403);
        $user = User::find($id);
        return view('users.edit', compact('user'));   
    }
  

    
    public function update(Request $request, $id)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);

        $request->validate([
            'name'=>'required',
            'email'=>'required',
           
            
        ]);

        
      
        $user = User::find($id);
        $user->name=  $request->get('name');
        $user->email = $request->get('email');
     
        
        $user->save();
      
        return redirect('users');
     }

   
    public function destroy($id)
    {
       
        abort_unless(\Gate::allows('isAdmin'), 403);
        $user = User::find($id);

        if ($user)  {
            if ($user->delete()){
    
            DB::statement('ALTER TABLE users AUTO_INCREMENT = '.(count(User::all())+1).';');
            }
         return redirect('users');
        }
    }
}