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
/*
Event::listen('illuminate.query', function($sql)
{
  var_dump($sql."<br>");
});
*/

Route::get('/', 'HomeController@showWelcome');
Route::get('/about', function(){
	return View::make('about/index');
});
Route::get('/about/changelog', function(){
	return View::make('about/changelog');
});


Route::post('/posts/filter', 'PostController@postFilter');
Route::resource('users', 'UserController');
Route::resource('posts', 'PostController');
Route::resource('teamposts', 'TeampostController');
Route::resource('shortlist', 'ShortlistController');
Route::get('/steamlogin/{action?}', array('as' => 'login', 'uses' => 'UserController@login'));
Route::get('/steamlogout', array('as' => 'logout', 'uses' => 'UserController@logout'));
Route::get('/review/{id}', array('as' => 'review', 'uses' => 'UserController@getReview'));
Route::post('review/{id}', 'UserController@postReview');
Route::post('/posts/{id}', 'PostController@postComment');
Route::post('/teamposts/{id}', 'TeampostController@postComment');
Route::post('/users/show/{id}', 'UserController@postStatus');