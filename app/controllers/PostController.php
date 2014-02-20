<?php

class PostController extends \BaseController {

	/**
	 * Set constructor to pass CSRF Token through all post submissions
	 *
	 */
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::with('user','lookingfors','playstyles', 'postcomments')->orderBy('id', 'DESC')->paginate(10);
		return View::make('posts/index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// Check if user is authenticated
		if (Auth::user())
		{
			// Get user, Lookingfors, playstyles
			$user = Auth::user();
			$lookingfors = Lookingfor::all();
			$playstyles = Playstyle::all();

			// Bring to posts/create View with user details
			return View::make('posts/create', compact('user', 'lookingfors', 'playstyles'));

		} else {
			// If not authenticated bring to register view
			return Redirect::action('PostController@index')->with('message', 'You must be logged in to make a post');
		}
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Pass all input from posts/create to validator with postRules from Post Model
		$validator = Validator::make(Input::all(), Post::$postRules, Post::$errorMessages);

		// Check if validator passes
		if($validator->fails()) 
		{
			// Redirect back to users/create with errors
			return Redirect::route('posts.create')->withErrors($validator)->withInput();
		} else {
			// Get user
			if (Auth::check()) {
				$user = Auth::user();
			}

			// Make new Post
			$post = new Post;
			
			// Associate User to Post
			$post = $user->posts()->save($post);
			
			// Get inputs
			$post->goal = Input::get('goal');
			$post->contact = Input::get('contact');
			$lookingfors = Input::get('lookingfors');
				$post->lookingfors()->sync($lookingfors);
			$playstyles = Input::get('playstyles');
				$post->playstyles()->sync($playstyles);

			$post->save();

			return Redirect::route('posts.index');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::find($id);

		// Get users
		$user = $post->user;
		
		// Get username and avatar
		$steam_user = $user->username;
		$steam_avatar = $user->avatar;

		// Pass statuses
		$status_options = Status::lists('name', 'id');

		// Get users ratings
		$ratings = Rating::where('user_id', $id)->get();

		return View::make('posts/show', compact('post','user', 'steam_avatar', 'steam_user', 'ratings', 'status_options'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// Get authenticated user
		$user = Auth::user();

		// Get post
		$post = Post::find($id);
		$lookingfors = Lookingfor::all();
		$playstyles = Playstyle::all();

		if (Auth::user()) {
			if ($user->id == $post->user->id) {
				return View::make('posts/edit', compact('user', 'post', 'lookingfors', 'playstyles'));
			}
		}
		return Redirect::to('posts/');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// Pass all input from posts/create to validator with postRules from Post Model
		$validator = Validator::make(Input::all(), Post::$postRules, Post::$errorMessages);

		// Check if validator passes
		if($validator->fails()) 
		{
			// Redirect back to users/create with errors
			return Redirect::route('posts.edit', [$id])->withErrors($validator)->withInput();
		} else {
			// Get user
			$user = Auth::user();

			// Get Post
			$post = Post::find($id);
			
			// Associate User to Post
			$post = $user->posts()->save($post);
			
			// Get inputs
			$post->goal = Input::get('goal');
			$post->contact = Input::get('contact');
			$lookingfors = Input::get('lookingfors');
				$post->lookingfors()->sync($lookingfors);
			$playstyles = Input::get('playstyles');
				$post->playstyles()->sync($playstyles);

			$post->save();

			return Redirect::to(route('posts.index').'#'.$post->id.'id');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Post::destroy($id);

		return Redirect::action('PostController@index');
	}

	public function postComment($id)
	{
		// Check if user leaving comment is logged int
		if(Auth::check()) {
			// Get post
			$post = Post::find($id);

			// Get inputs and users

			$comment = new PostComment;
			$comment->post_id 	= $id;
			$comment->author_id = Auth::user()->id;
			$comment->comment 	= Input::get('comment');
			$comment->save();

			return Redirect::route('posts.show', [$id]);

			// Store Inputs

			// Return to post

		} else {
			return Redirect::route('posts.show', [$id])->with('message', 'You have to be logged in');
		}
	}
}