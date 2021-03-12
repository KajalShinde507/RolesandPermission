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
Route::get('/treadname', 'VerifyUserController@getTreadName');
Route::get('/returnperiod', 'VerifyUserController@getReturnPeriod');
Route::get('/deactivate', 'VerifyUserController@deactive');
Route::post('/deactivate', 'VerifyUserController@deactive');
Route::get('reactive/{id}', 'VerifyUserController@reactive');
Route::post('reactive/{id}', 'VerifyUserController@reactive');
Route::post('userregistration', 'Auth\RegisterController@registerusers');

Route::get('/user/verifymail/{token}', 'VerifyUserController@verifyAdmin');
Route::get('/user/verifyAdminmail/{token}', 'VerifyUserController@verifyAdmin');
Route::post('/user/verifyAdminmail', 'VerifyUserController@changepassword');
Route::post('/user/verifyusermail', 'VerifyUserController@verifyUser');

Route::get('/home', 'HomeController@index');
Route::get('/adminlte', 'HomeController@index1')->middleware('auth');

Route::resource('main','BookController');
Route::get('/read','BookController@read');
Route::get('/main/destroy/{id}', 'BookController@destroy')->middleware('can:isAdmin');
Route::get('/importbook', 'BookController@importExportView')->middleware('can:isAdmin');
Route::get('/importsale', 'BookController@importExportViewsale')->middleware('can:isAdmin');
Route::get('/importsalereport','BookController@importExportViewsalereport')->middleware('can:isAdmin');
Route::post('/importsale_rgreport','BookController@importViewsalereport')->middleware('can:isAdmin');
Route::post('/import', 'BookController@import')->middleware('can:isAdmin');
Route::post('/importsale_rg', 'BookController@importsale')->middleware('can:isAdmin');
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
Route::get('/users/resend/{id}', 'UserController@resendlink');
Route::post('/users/resend/{id}', 'UserController@resendlink');




 
Route::resource('users','UserController')->middleware('can:isAdmin');
Route::resource('roles','RolesController')->middleware('can:isAdmin');;
Route::get('/readrole','RolesController@readrole')->middleware('can:isAdmin');
Route::get('/readroleonly','RolesController@readroleonly')->middleware('can:isAdmin');
 Route::get('/users/destroy/{id}', 'UserController@destroy')->middleware('can:isAdmin');
 Route::get('/readuser','UserController@read')->middleware('can:isAdmin');
 Route::get('edituser','UserController@editUser')->middleware('can:isUser');
 Route::get('userprofile','UserController@editUser')->middleware('can:isUser');
 Route::patch('users/updateuser/{id}','UserController@updateuser')->middleware('can:isUser');



 Route::get('updateuser',function () {
  return view('userupdate');
})->middleware('can:isUser');


//Route::get('gstreport', 'VerifyUserController@getTreadName')->middleware('can:isManager');
 Route::get('/addfavouritesauth', 'FavouriteauthController@store')->middleware('can:isUser');
 Route::post('/addfavouritesauth', 'FavouriteauthController@store')->middleware('can:isUser');
 Route::post('/readauthor','AuthorController@readauthor')->middleware('can:isUser');
 Route::get('/addfavourite', 'FavoritebookController@store')->middleware('can:isUser');
 Route::post('/addfavourite', 'FavoritebookController@store')->middleware('can:isUser');

 Route::get('/softdelete', 'BookController@softstore')->middleware('can:isAdmin');
 Route::post('/softdelete', 'BookController@softstore')->middleware('can:isAdmin');
 Route::get('/softdeleteauth', 'AuthorController@softstore')->middleware('can:isAdmin');
 Route::post('/softdeleteauth', 'AuthorController@softstore')->middleware('can:isAdmin');
 
Route::get('/favouritedbyuserbooks','FavoritebookController@get')->middleware('can:isUser');
Route::get('/readfavbook','FavoritebookController@readfav')->middleware('can:isUser');
Route::get('/favouritedbyuserauthors','FavouriteauthController@get')->middleware('can:isUser');
Route::get('/readfavauthor','FavouriteauthController@readfav')->middleware('can:isUser');


//Route::get('salergreport', 'UserController@gstreport')->middleware('can:isManager');
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

Route::get('/salerg', 'VerifyUserController@selectsale')->middleware('can:isManager');
Route::post('/salerg', 'VerifyUserController@selectsale')->middleware('can:isManager');
Route::get('/exportkoolsale_rg', 'VerifyUserController@selecttreadname')->middleware('can:isManager');
Route::post('/exportkoolsale_rg', 'VerifyUserController@selecttreadname')->middleware('can:isManager');
Route::post('/downloadexcel', 'VerifyUserController@downloadexcel')->middleware('can:isManager');
Route::get('/downloadexcel', 'VerifyUserController@downloadexcel')->middleware('can:isManager');
//Route::get('/salerg', 'VerifyUserController@selecttreadname')->middleware('can:isManager');
//Route::post('/salerg', 'VerifyUserController@selecttreadname')->middleware('can:isManager');
Route::get('salergreport', 'UserController@salereport')->middleware('can:isManager');
Route::get('salereportfilter', 'VerifyUserController@salereport')->middleware('can:isManager');
Route::get('/salergreports', 'VerifyUserController@salereportview')->middleware('can:isManager');
Route::get('/welcomemail',function () {
  return view('emails.welcome');
});


 Route::get('/sample','BookController@sample');



 Route::get('activationpending',function () {
  return view('emails.activation');
});













