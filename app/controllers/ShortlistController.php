<?php

class ShortlistController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check()) {
			$author = Auth::user();
			$users = Shortlist::where('author_id', $author->id)->get();

			return View::make('users/shortlist', compact('author', 'users'));		
			//return Redirect::route('posts.index');
		} else {
			return Redirect::action('PostController@index')->with('message', 'You must be logged in to do this.');
		}

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if (Auth::check()) {
		// Return a users shortlist
		$author = User::find($id);
		$users = Shortlist::with('user')->where('author_id', $id)->orderBy('created_at', 'DESC')->get();

		return View::make('users/shortlist', compact('author', 'users'));
		} else {
			return Redirect::action('PostController@index')->with('message', 'You must be logged in to do this.');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (Auth::check()) {
			$author = Auth::user();
			$user = User::find($id);

			$shortlist = new Shortlist;
			$shortlist->author_id = $author->id;
			$shortlist->user_id = $user->id;
			$shortlist->save();

			return Redirect::route('posts.index')->with('message', 'User successfully added to Shortlist. To check your list go through the user menu at the top.');
		} else {
			return Redirect::route('posts.index')->with('message', 'You must be logged in to do this.');
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
		Shortlist::destroy($id);
		$author = Auth::user();
		return Redirect::action('ShortlistController@show', [$author->id]);
	}

}