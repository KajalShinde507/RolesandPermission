<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function store(Request $request)  
{  
 // print_r($request->input('username'));  
 $user=$request->session()->get('username'); 
 if($user['username'] =='kajalshinde')  
 {
     return redirect('/api/main');
 }
 else{
     return redirect('/');
 }
}



}
