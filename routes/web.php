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
Route::get('/adminlte', 'HomeController@index1')->middleware('auth');

Route::resource('main','BookController');
Route::get('/read','BookController@read');
Route::get('/main/destroy/{id}', 'BookController@destroy')->middleware('can:isAdmin');
Route::get('/importbook', 'BookController@importExportView')->middleware('can:isAdmin');
Route::post('/import', 'BookController@import')->middleware('can:isAdmin');
Route::post('/exportbook', 'BookController@export')->middleware('can:isAdmin');

Route::get('mailview',function () {
  return view('main.mail');
})->middleware('can:isAdmin');
Route::post('/sentmail','BookController@sentpost')->middleware('can:isAdmin');


Route::resource('sub','AuthorController');
Route::get('/readauthor','AuthorController@readauthor');
Route::get('/sub/destroy/{id}', 'AuthorController@destroy')->middleware('can:isAdmin');
Route::get('/importauthor', 'AuthorController@importExportView')->middleware('can:isAdmin');
Route::post('/importauth', 'AuthorController@import')->middleware('can:isAdmin');
Route::post('/exportauth', 'AuthorController@export')->middleware('can:isAdmin');

 
Route::resource('users','UserController')->middleware('can:isAdmin');
Route::resource('roles','RolesController')->middleware('can:isAdmin');;
Route::get('/readrole','RolesController@readrole')->middleware('can:isAdmin');
Route::get('/readroleonly','RolesController@readroleonly')->middleware('can:isAdmin');
 Route::get('/users/destroy/{id}', 'UserController@destroy')->middleware('can:isAdmin');
 Route::get('/readuser','UserController@read')->middleware('can:isAdmin');
 Route::get('edituser','UserController@editUser')->middleware('can:isUser');
 Route::post('users/updateuser/{id}','UserController@updateuser')->middleware('can:isUser');


 Route::get('/addfavouritesauth', 'FavouriteauthController@store')->middleware('can:isUser');
 Route::get('/addfavourite', 'FavoritebookController@store')->middleware('can:isUser');
 Route::get('/addfavourites','FavoritebookController@bookFavBook')->middleware('can:isUser');



 Route::get('bookreport', 'BookController@bookreport')->middleware('can:isManager');
Route::get('authorreport', 'AuthorController@authorreport')->middleware('can:isManager');
Route::get('userreport', 'UserController@userreport')->middleware('can:isManager');
Route::get('favreport', 'BookController@favreport')->middleware('can:isManager');
Route::get('/exportkool', 'BookController@bookkoolexport')->middleware('can:isManager');
Route::get('/exportkoolauth', 'AuthorController@authorkoolexport')->middleware('can:isManager');
Route::get('/exportkooluser', 'UserController@userkoolexport')->middleware('can:isManager');
Route::get('/exportkoolfav', 'BookController@favkoolexport')->middleware('can:isManager');
Route::get('/exportkoolbookbyauthor', 'BookController@bookbyauthorexport')->middleware('can:isManager');
Route::post('/exportkoolbookbyauthor', 'BookController@bookbyauthorexport')->middleware('can:isManager');
Route::get('bookselectreport', 'BookController@selectbookbyauthor')->middleware('can:isManager');
Route::post('bookselectreport', 'BookController@selectbookbyauthor')->middleware('can:isManager');






 












