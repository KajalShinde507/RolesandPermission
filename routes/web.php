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
Route::get('product/create', 'ProductController@create')->name('product.create');

Route::get('product/{product}', 'ProductController@show')->name('product.show');

});





Route::group(['middleware'=>['auth','admin']],function(){
  Route::get('admin',function () {
      return view('admin');
   });

   

  Route::resource('main','BookController');
  Route::post('fetchbook', 'BookController@fetch')->name('pagination.fetchbook');
 
  Route::resource('sub','AuthorController');
  Route::post('fetch', 'AuthorController@fetch')->name('pagination.fetch');
 
  Route::get('importbook', 'BookController@importExportView');
  Route::post('/import', 'BookController@import');

  
Route::post('/exportbook', 'BookController@export');
Route::post('/exportauth', 'AuthorController@export');

Route::get('testemail','BookController@mailsent');
Route::get('/test', 'BookController@sent');
Route::post('/test1','BookController@sentpost');
Route::get('importauthor', 'AuthorController@importExportView');
Route::post('/importauth', 'AuthorController@import');

});












 














