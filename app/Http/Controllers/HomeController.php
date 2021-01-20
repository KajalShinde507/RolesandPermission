<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use Role;

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



    /**

     * Show the my users page.

     *

     * @return \Illuminate\Http\Response

     */

    public function myUsers()

    {

        return view('myUsers');

    }
}
