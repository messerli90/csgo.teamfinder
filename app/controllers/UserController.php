<?php

class UserController extends \BaseController {

	/**
	 * Set constructor to pass CSRF Token through all post submissions
	 *
	 */
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('guest', array('only'=>'getLogin'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::paginate(25);
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
		// Pass all input from users/create to validator with registrationRules from User Model
		$validator = Validator::make(Input::all(), User::$registrationRules);

		// Check if validator passes
		if($validator->fails()) 
		{
			// Redirect back to users/create with errors
			return Redirect::route('users.create')->withErrors($validator)->withInput();
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
		$ratings = Rating::where('user_id', $id)->get();

		// Return Profile Page of user
		return View::make('users/profile', compact('user', 'ratings'));
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

			//
			$region_options = Region::lists('name', 'id');
			$rank_options = Rank::lists('name', 'id');
			$skill_options = Skill::lists('name', 'id');
			$voips = Voip::all();

			// Find user's current set birthday and break it into array
			if($user->birthday)
				$birthday = explode('-',$user->birthday);


			// If the logged in used is the same as the user they are trying to edit, allow
			if ($authUserID == $id) {
				// Return Edit Page for user
				return View::make('users/edit', compact('user', 'region_options', 'rank_options', 'skill_options', 'voips', 'birthday'));
			} else {
			// Else, return to root
			return Redirect::to('/');
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
		$user = User::find(Auth::user()->id);
		$input = Input::get();

		// Pass all input from users/edit to validator with rules from User Model
		$validator = Validator::make(Input::all(), User::$editRules);

		if ($validator->fails()) {
			return Redirect::action('UserController@edit', [$user->id])->withErrors($validator);
		}

		if (Input::hasFile('avatar')) {
			$file            = Input::file('avatar');
			$destinationPath = public_path().'/img/avatars';
			$filename        = str_random(6) . '_' . $file->getClientOriginalName();
			$uploadSuccess   = $file->move($destinationPath, $filename);
			$user->avatar    = $destinationPath . $filename;
		}
		$day = Input::get('day');
		$month = Input::get('month');
		$year = Input::get('year');
		$user->birthday = $year.'-'.$month.'-'.$day;
		if (Input::has('steam')) 
			$user->steam = Input::get('steam');
		if (Input::has('esea')) 
			$user->esea = Input::get('esea');
		if (Input::has('leetway')) 
			$user->leetway = Input::get('leetway');
		if (Input::has('altpug')) 
			$user->altpug = Input::get('altpug');
		if (Input::has('region_id')) 
			$user->region_id = Input::get('region_id');
		if (Input::has('skill')) 
			$user->skill_id = Input::get('skill');
		if (Input::has('rank')) 
			$user->rank_id = Input::get('rank');
		if (Input::has('bio'))
			$user->bio = Input::get('bio');
		$user->save();
		if (Input::has('voips')) {
			$voips = Input::get('voips');
			$user->voips()->sync($voips);
		}
		$user->save();
		return Redirect::action('UserController@show', [Auth::user()->id])->with('user', $user);

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
	/**
	 * Get the Login View
	 *
	 */
	public function getLogin()
	{
		// Create the login View
		return View::make('users/login');
	}

	/**
	 * Logging the User in
	 *
	 */
	public function postLogin()
	{
		// Grab input from Login Form
		$email = Input::get('email');
		$password = Input::get('password');

		if(Auth::attempt(['email' => $email, 'password' => $password]))
		{
			return Redirect::action('UserController@show',[Auth::user()->id])->with('user', Auth::user());
		} else {
			return Redirect::action('UserController@getLogin')->with('error', 'Email/Password combination invalid')->withInput();
		}
	}
	
	/**
	 * Logging the User out
	 *
	 */
	public function getLogout()
	{
		Auth::logout();
		return Redirect::action('UserController@getLogin');
	}

	/**
	 * Get Review Page
	 *
	 */
	public function getReview($id)
	{
		$user = User::find($id);
		if(Auth::user() == $user)
		{
			return Redirect::action('UserController@show', [$user->id])->with('message', "You cannot leave a review for yourself");
		}
		elseif (!Auth::user()) {
			return Redirect::route('login');
		} 
		return View::make('users/review')->with('user', $user);
	}

	/**
	 * Post Review
	 *
	 */
	public function postReview($id)
	{
		// User that is receiving review
		$user = User::find($id);

		// Pass all input from users/review to validator with rules from User Model
		$validator = Validator::make(Input::all(), User::$reviewRules);

		if ($validator->fails()) {
			return Redirect::action('UserController@getReview', [$user->id])->withErrors($validator);
		}


		//User that is writing review
		$author_id = Auth::user()->id;

		$rating = new Rating;
		$rating->score = Input::get('score');
		$rating->review = Input::get('review');
		$rating->user_id = $user->id;
		$rating->author_id = $author_id;
		$rating->save();

		$user->rating = $user->rating + Input::get('score');
		$user->save();

		return Redirect::action('UserController@show', [$user->id]);
	}
}
