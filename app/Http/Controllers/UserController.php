<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\VerifyUser;
use App\Mail\VerifyAdminMail;
use App\Mail\VerifyMail;
use  App\Rules\MatchOldPassword;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;


use App\Reports\userReport;
use App\Reports\sale_regReport;

class UserController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        
       
    }





    public function salereport()
    {
        return view("Reports.salereport");
    }

public function gstreport()
{
    
        abort_unless(\Gate::allows('isManager'), 403);
        $report = new sale_regReport;
        $report->run();
        return view("Reports.gstreport",["report"=>$report]);
    
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
            'password' => ['required', 'string', 'min:8', 'confirmed','unique:users'],
            'role'=>['required','string'],
            'gender'=>['required','string'],
            'user_status'=>['sometimes'],
        ]);
    }

    protected function store(Request $request)
    {
        abort_unless(\Gate::allows('isAdmin'), 403);

        $day=config('status.activation_link');
        $value=config('status.activation_pending');
       $user= User::create([
            'name' => $request['name'],
            'email' => $request['email'],
                 
            $pass=  $request['email'],
            'password' => md5($pass),
            'role' => $request['role'],
            'gender' => $request['gender'],
            'user_status'=> $value,
        ]);

        if($user->role=='1' || $user->role=='2')
        {
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
            
          ]);
          \Mail::to($user->email)->send(new VerifyAdminMail( $user,$pass,$day));
        }
        else if ($user->role=='3'){

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
              ]);
              \Mail::to($user->email)->send(new VerifyMail( $user,$day));
             
        }
          

        $user->save();

    
    
        
      return redirect('users');
    }
   

    
    
    
    public function editUser(Request $request)
    {
        abort_unless(\Gate::allows('isUser'), 403);
        
        return view('userprofile')->with('user', Auth::user());
    }





    public function updateuser(Request $request, $id)
    {
        
        abort_unless(\Gate::allows('isUser'), 403);


        $request->validate([
            
            
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'gender' => 'required',
            'dob' => 'sometimes',
            'profile_picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            
        ]);

       



        $user = User::find($id);
        $user->name=  $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request['password']);
        $user->gender=$request->get('gender');
        $user->dob=$request->get('dob');
         
        if($request->hasFile('profile_picture')){

            $profile= request()->file('profile_picture');
            $filename=time().'.'.$profile->getClientOriginalExtension();
            $file_path=public_path('/Uploads/');
            $profile->move($file_path,$filename);
            $user->profile_picture=$filename;
            
             }

        $user->save();
        return redirect()->back()->with('success',' User profile Update successfully');
        
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
            'password'=>'required',
            'gender' => 'required',
            
            'dob' => 'sometimes',
            'profile_picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
           
            
        ]);

        
      
        $user = User::find($id);
        $user->name=  $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request['password']);
        $user->gender=$request->get('gender');
        $user->dob=$request->get('dob');
         
        if($request->hasFile('profile_picture')){

            $profile= request()->file('profile_picture');
            $filename=time().'.'.$profile->getClientOriginalExtension();
            $file_path=public_path('/Uploads/');
            $profile->move($file_path,$filename);
            $user->profile_picture=$filename;
            
             }

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


    public function resendlink(Request $request ,$id)
    {
        
        $user=User::find($id);
       $user_id=$id;
       
       $verifyUser = VerifyUser::create([
            'user_id' => $user_id,
            'token' => sha1(time())
            
          ]);
          $useremail = User::where('id',$id)->first(['email']);
          $role = User::where('id',$id)->first(['role']);
               $pass=md5( $useremail);
            
                 if($user->role=='1' || $user->role=='2'){
           
                      \Mail::to($useremail)->send(new VerifyAdminMail( $user,$pass));
                      if($user->user_status==2 || $user->user_status==3){
                      $value=config('status.activation_pending');
                          $user->user_status=$value;
                          $user->update();
                      return redirect()->back()->with('success',' send activation mail to admin successfully');
                 }
                    }
                else if($user->role=='3'){

                   \Mail::to($useremail)->send(new VerifyMail( $user));


                   if($user->user_status==2||$user->user_status==3){
                    $value=config('status.activation_pending');
                        $user->user_status=$value;
                        $user->update();
                   return redirect()->back()->with('success',' send activation mail to user successfully'); 
                  }
                }
       
        
    
    return redirect()->back();  
  } 
}