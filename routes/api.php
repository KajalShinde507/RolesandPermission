<?php

use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookCollection;
use App\Book;
use App\Author;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*\DB::listen(function($query) {
    var_dump($query->sql);
});*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('main','book1Controller');
//Route::resource('sub','AuthorController');

Route::get('/books/{book}', function(Book $book) {
    return new BookResource($book);
});

Route::get('/books', function() {
    return new BookResource(Book::all());//throws the exception
});
Route::get('/book', function() {
    return BookResource::collection(Book::all());
  // return new BookCollection(Book::with('authorname')->get());
});

Route::get('/bookcol', function() {
    return new BookCollection(Book::all());
});

Route::get('/bookp', function () {
    return new BookCollection(Book::paginate());
});

Route::get('/book1', function() {
    //return BookResource::collection(Book::all());
   return new BookCollection(Book::with('authors')->get());
});