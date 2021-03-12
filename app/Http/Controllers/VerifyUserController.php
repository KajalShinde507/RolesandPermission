<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\VerifyUser;
use Auth;
use DB;
use Response;
use File;
use Excel;
use Session;
use DateTime;
use App\Mail\VerifyAdminMail;
use App\Mail\VerifyMail;
use App\Mail\Deactive;
use App\Reports\sale_regReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class VerifyUserController extends Controller
{



    public function verifyUser(Request $request)
    {
        
       

       $verifyUser = VerifyUser::where('token', $request->token)->first();

        if (!empty($verifyUser))
        {
          
            $user=$verifyUser->user;
          if ($user->user_status == 2 || $user->user_status == 3)
                {

                    $data = config('status.active');

                    $verifyUser
                        ->user->user_status = $data;

                    $verifyUser
                        ->user
                        ->update();
                    $status = "Your account is verified. You can now login.";

                }

                else
                {

                    $status = "Your account is  already verified. You can now login.";
                }
            
            return redirect('/adminlte')
                ->with('status', $status);
            
        }
        else

        {

                return redirect('/login')
                    ->with('warning', "Sorry your link cannot be identified.");

        }
        

    }














    public function verifyAdmin(Request $request, $token)
    {      
       

        if (Auth::check())
        {
        
            return view('errors.403');
        }
     else{
          $verifyUser = VerifyUser::where('token', $token)->first();

       
        if (!empty($verifyUser))
        {
            
          $nowtime = Carbon::now();
          $totalDuration = Carbon::createFromFormat('Y-m-d H:i:s', $verifyUser->created_at)
              ->diffInDays($nowtime);
  
            $user = $verifyUser->user;
            if ($totalDuration >=2)
              {

                 $verifyUser->delete();

                 return redirect('/login')
                 ->with('warning', "Sorry link is expire click on resend link.");
                }
          else
            { 
               if($user->role==1 || $user->role==2)
                {
                return view('changepassword', compact('verifyUser'));
                }
                else if($user->role==3)
                {
                    return view('emails.login', compact('verifyUser'));  
                }
            }
        }
        else{
            return redirect('/login')
                 ->with('warning', "link not identified"); 
        }
        
    }
    
    }

    public function changepassword(Request $request)
    {
        $email = verifyUser::where('token', $request->token)
            ->join('users', 'users.id', '=', 'verify_users.user_id')
            ->select('users.email')
            ->first();

        $request->validate([

        'current_password' => ['required', new MatchOldPassword($email) ], 'new_password' => ['required', 'min:8'], 'new_confirm_password' => ['same:new_password'], ]);

        $verifyUser = VerifyUser::where('token', $request->token)
            ->first();

        if (!empty($verifyUser))
        {

            $user = $verifyUser->user;

            if ($user->user_status == 2 || $user->user_status == 3)
            {

                $data = config('status.active');
                $verifyUser
                    ->user->user_status = $data;
                $verifyUser
                    ->user->password = Hash::make($request['new_password']);
                $verifyUser
                    ->user
                    ->update();
                $status = "Your account is verified. You can now login.";

            }

            else
            {

                $status = "Your account is  already verified. You can now login.";
            }

            return redirect('/login')
            ->with('status', $status);
        }

        else
        {
           

         return redirect('/login')
                    ->with('warning', "Sorry your link cannot be identified.");

            
        }
       

    }



    public function deactive(Request $request)
    {
        $id = $request['id'];
        $user =  User::where('id',$id)->first(); 
         
           
        if ($user->user_status == 1)
        {

            $data = config('status.deactivate');
           $user->user_status = $data;

            $user->save();
        
        \Mail::to($user->email)->send(new Deactive( $user));
        
        

            return response()->json(['message'=>'Deactivated by Admin']); 

        }
       
      



    }

public function reactive($id)
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

public function getTreadName()
{
$sale=DB::table('final_outward_sales_reg')->select('gstin_uin_of_supplier')->get();
return response()->json($sale);
}

public function getReturnPeriod()
{
//$sale=DB::table('final_outward_sales_reg')->select('date_format('fp',"%M%Y")')->get();
return response()->json($sale);
}






public function selecttreadname(Request $request)
{   
    $treadname = $request->get('gstin_uin_of_supplier');
    
    $fpd = $request->get('fp');
    $doc = $request->get('doctype');
    $sta = $request->get('status');
    $cat = $request->get('category');
    $summa = $request->get('summary');
   // $saledata=$request->all();
   


    $report = new sale_regReport(array("gstin_uin_of_supplier"=>$treadname, "fp"=>$fpd,"doc_type"=>$doc, "salestatus"=>$sta,"category"=>$cat,"summary"=>$summa));
    
   
    

    $data=$report->run()->exportToExcel('sale_regReportExcel')->saveAs("../storage/myreport.xlsx");
   
   $path = storage_path('myreport.xlsx');
   
    return response()->json($path);
  
}


public function downloadexcel()
{
    $file=  "../storage/myreport.xlsx";

    $headers = array(
              'Content-Type: application/xlsx',
            );

    return Response::download($file, 'salereport.xlsx', $headers);
}


public function selectsale(Request $request)
{
       

      
    //$response = $request->all();
     //return \Response::json($response);
    $treadname = $request->get('gstin_uin_of_supplier');
    
    $fpd = $request->get('fp');
    $doc = $request->get('doctype');
    $sta = $request->get('status');
    $cat = $request->get('category');
    $summa = $request->get('summary');
   
    //dd($fpd,$doc,$sta,$cat,$summa);
    $report = new sale_regReport(array("gstin_uin_of_supplier"=>$treadname, "fp"=>$fpd,"doc_type"=>$doc, "salestatus"=>$sta,"category"=>$cat,"summary"=>$summa));
    
    //dd($report->run()->render());
  return $report->run()->render();
  

}


public function salereport()
{

    return view("Reports.salereportfilter");
}
public function salereportview()
{
    return view("Reports.salereportview");  
}

}

