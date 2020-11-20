<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::group(['middleware'=>['auth','nonadmin']],function(){
Route::get('nonadmin',function () {
  return view('nonadmin');
 
});
Route::get('booklist','BookController@show1');
Route::get('authorlist','AuthorController@show1');
});
Route::group(['middleware'=>['auth','admin']],function(){
  Route::get('admin',function () {
      return view('admin');
});
  
  Route::resource('main','BookController');
  Route::resource('sub','AuthorController');
 
  
});


