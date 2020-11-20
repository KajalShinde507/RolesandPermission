<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use\Illuminate\Http\Request;
//use User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /*protected function authenticated(Request $request,$user)
    {
      
        if($user->isAdmin()==1)
        {
            return redirect('admin');
        }
        return redirect('nonadmin');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function submit(Request $request)
    {
        //$request->session()->put('user', $request->input());
        $user=$request->session()->get('user'); 
        if($info['email']=='kajalshinde507@gmail.com')  
        {
            return redirect('/api/main');
        }
        else{
            return redirect('/login');
        }
    }  


    
}
