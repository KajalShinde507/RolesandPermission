<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use Role;

use App\VerifyUser;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       return view('home');
       //return view('adminlte.Dashboard');
    }



    public function index1()
    {
       //return view('layouts.admin');
       return view('adminlte');
    }
    public function test()

    {

        return view('testhome');

    }

    public function page()
    {
       //return view('layouts.admin');
       return view('auth.login');
    }

    /**

     * Show the my users page.

     *

     * @return \Illuminate\Http\Response

     */

    public function myUsers()

    {

        return view('myUsers');

    }
    public function verifyUser($token)
    {
      $verifyUser = VerifyUser::where('token', $token)->first();
            
         
      if($verifyUser){
   
  //$user = $verifyUser->user;

  if($verifyUser->user->user_status == 2) {
      
      $data=config('status.active');
  
    $verifyUser->user->user_status = $data;

    $verifyUser->user->update();
    $status = "Your account is verified. You can now login.";
    
     } 

  else {

      $data=config('status.active');
      //$data= config('status.activation_pending');
      
    $verifyUser->user->user_status = $data;

    $verifyUser->user->update();
    $status = "Your activation pending. please check the mail";
  
  }

  } 
else 
  {
      return view('auth.login');
     // return redirect('/login')->with('warning', "Sorry your link cannot be identified.");
    }
    //return redirect('/login')->with('status', $status);
    return view('auth.login');
}





}
