<?php

class UserController extends \BaseController {

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
		$users = User::all();
		return View::make('users/index')->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Pass all input from users/create to validator with rules from User Model
		$validator = Validator::make(Input::all(), User::$rules);

		// Check if validator passes
		if($validator->fails()) 
		{
			// Redirect back to users/create with errors
			return Redirect::route('users.create')->withErrors($validator);
		} else {
			// Validation has passed, save user in DB
			$user = new User;
			$user->username = Input::get('username');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			// Manually log in user
			Auth::login($user);

			// Redirect user to Edit Profile Page
			return Redirect::action('UserController@edit', [$user->id])->with('message', 'Thank you for registering! Be sure to complete your profile.');
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
		// Pick out the user
		$user = User::find($id);

		// Return Profile Page of user
		return View::make('users/profile')->with('user', $user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// Pick out the user
		$user = User::find($id);

		// Check if user is logged in
		if (Auth::user())
		{
			// Get Authenticated user
			$authUserID = Auth::user()->id;

			// If the logged in used is the same as the user they are trying to edit, allow
			if ($authUserID == $id) {
				// Return Edit Page for user
				return View::make('users/edit')->with('user', $user);
			}
		} else {
			// Else, return to root
			return Redirect::to('/');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Pick out the user
		$user = User::find($id);

		// Delete user from Database
		$user->delete();
	}

}