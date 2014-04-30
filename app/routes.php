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

// Sitemap
Route::get('sitemap', function(){
  // Initialize sitemap
  $sitemap = App::make("sitemap");

  // Add static pages
  $sitemap->add(URL::to('/'), '2014-04-29T16:00:00+01:00', '1.0', 'daily');
  $sitemap->add(URL::to('about'), '2014-04-29T16:00:00+01:00', '0.7', 'monthly');
  $sitemap->add(URL::to('posts'), '2014-04-29T16:00:00+01:00', '0.7', 'monthly');

  // Add dynamic pages
  $posts = Post::all();
  $teamposts = Teampost::all();

  foreach ($posts as $post) {
    $sitemap->add(URL::to("posts/$post->id"), $post->created_at, '0.9', 'weekly');
  }

  foreach ($teamposts as $post) {
    $sitemap->add(URL::to("posts/$post->id"), $post->created_at, '0.9', 'weekly');
  }
  
  // Output sitemap
  return $sitemap->render('xml');
});

Route::get('/', 'HomeController@showWelcome');
Route::get('/about', function(){
	return View::make('about/index');
});
Route::get('/about/changelog', function(){
	return View::make('about/changelog');
});
Route::get('/faq', function(){
  return View::make('about/faq', compact('playstyles'));
});
Route::get('/markdown', function(){
  return View::make('about/markdown');
});


Route::resource('users', 'UserController');
Route::any('/posts/filter', 'PostController@postFilter');
Route::any('/teamposts/filter', 'TeampostController@postFilter');
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
Route::post('users/show/{id}', 'UserController@postResync');