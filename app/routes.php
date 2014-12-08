<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::post('users/{id}/resetPassword', 'UsersController@resetPassword');

/*
Route::get('books/api/', 'BooksApiController@index');
Route::get('books/api/{id}', 'BooksApiController@show');
Route::post('books/{id}/borrowApi', 'BooksApiController@borrow');*/

App::error(function($exception, $code)
{

	switch ($code)
	{
		case 404:
			return View::make('errors/404');
	}

});

Route::group(array('prefix' => 'api'), function()
{
	Route::resource('books', 'BooksApiController');
	Route::resource('reviews', 'ReviewsApiController');
	Route::post('books/{id}/borrow', 'BooksApiController@borrow');
	Route::post('login', 'UsersController@apiLogin');
});

Route::get('/', function(){
	return Redirect::to('login');
});

Route::get('login', 'UsersController@showLogin');

Route::post('login', 'UsersController@attemptLogin');

Route::get('logout', 'UsersController@doLogout');
Route::resource('users', 'UsersController');

Route::resource('books', 'BooksController');
Route::post('books/{id}/borrow', 'BooksController@borrow');

Route::resource('reviews', 'ReviewsController');
Route::post('reviewsApi', 'ReviewsApiController@store');

Route::get('books/images', function(){
	return Response::json(Book::all());
});

Route::post('books/{i}/borrowAs/{j}', 'BooksController@borrowAs');
Route::post('books/{i}/return', 'BooksController@returnBook');