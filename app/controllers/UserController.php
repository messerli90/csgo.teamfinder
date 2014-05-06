	<?php

class UserController extends \BaseController {

	/**
	 * Set constructor to pass CSRF Token through all post submissions
	 *
	 */
	public function __construct(Hybrid_Auth $hybridAuth)
    {
    $this->hybridAuth = $hybridAuth;
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
		$users = User::paginate(100);
		return View::make('users/index')->with('users', $users);
	}

	/**
	 * HybridAuth Steam Login
	 *
	 *
	 */
	public function login($action='')
	{
		if ( $action == "auth" ) {
			try {
			 Hybrid_Endpoint::process();
			}
			catch ( Exception $e ) {
			 echo "Error at Hybrid_Endpoint process (UserController@login): $e";
			}
			return;
		}

		// Authenticate with Steam (using the details from our IoC Container).
		$hybridAuthProvider = $this->hybridAuth->authenticate( "Steam" );

		// Get user profile information
		$hybridAuthUserProfile = $hybridAuthProvider->getUserProfile();

		// Get Community ID
		$steamCommunityId = str_replace( "http://steamcommunity.com/openid/id/", "", $hybridAuthUserProfile->identifier );

		//See if user exists
		$user = User::find($steamCommunityId);

		// Create SteamId Object
		$steamIdObject = new SteamId( "$steamCommunityId" );

		// Check DB 
		if($user != null) {
			while (!Auth::check()) {
				try {
					// Update Info
					$user 						= User::find($steamCommunityId);
					$user->username 	= $steamIdObject->getNickname();
					$user->avatar 		= $steamIdObject->getFullAvatarUrl();
					$user->save();

					Auth::login($user, true);
				} catch (Exception $e) {
					//
				}
			}

			// If the user exists in the DB sign in and return to profile
			return Redirect::action('UserController@show', [$steamCommunityId])->with('message', "You have successfully logged in. Be sure to complete your Profile");

		} else {
			while (!Auth::check()) {
				try {
					// Create a new user
					$user 						= new User;
					$user->id 				= $steamCommunityId;
					$user->username 	= $steamIdObject->getNickname();
					$user->avatar 		= $steamIdObject->getFullAvatarUrl();
					$user->save();

					Auth::login($user, true);
				} catch (Exception $e) {
					//
				}
			}

			// Log user in manually and redirect to Edit page
			// Loop back to login 
			return Redirect::action('UserController@show', [$steamCommunityId])->with('message', 'Thank you for registering. <strong>Be sure to complete your profile</strong>.');

		}
	}

	/**
	 * HybridAuth Steam Logout
	 *
	 *
	 */
	public function logout()
	{
		// Logout
		$this->hybridAuth->logoutAllProviders();
		Auth::logout();

		// Flush Session
		Session::flush();

		return Redirect::action('HomeController@showWelcome');
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
		// Pick out the user
		$user = User::find($id);

		// Initiate Parsedown
    $parsedown = new Parsedown();

		// Get all user's ratings
		$ratings = Rating::where('user_id', $id)->get();

		// Pass statuses
		$status_options = Status::lists('name', 'id');

		// Get username and avatar
		$steam_user = $user->username;
		$steam_avatar = $user->avatar;

		// Return Profile Page of user
		return View::make('users/profile', compact('user', 'ratings', 'steam_user', 'steam_avatar', 'status_options', 'parsedown'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// Check if user is logged in
		if (Auth::user()) {			
			// Pick out the user
			$user = User::find($id);

			// Get Authenticated User
			$authUserID = Auth::user()->id;

			// Find user's current set birthday and break it into array
			if($user->birthday)
				$birthday = explode('-',$user->birthday);

			// Generate lists
			$region_options = Region::lists('name', 'id');
			$rank_options = Rank::lists('name', 'id');
			$skill_options = Skill::lists('name', 'id');
			$voips = Voip::all();

			// If the logged in user is the same as the user they are trying to edit, allow
			if ($authUserID == $id) {
				// Return Edit Page for user
				return View::make('users/edit', compact('user', 'region_options', 'rank_options', 'skill_options', 'voips', 'birthday'));
			} else {
				// Else, return to root
				return Redirect::to('/');
			}
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
		// Get User and Inputs		
		$user = User::find($id);
		$input = Input::get();

		// Pass all input from users/edit to validator with rules from User Model
		$validator = Validator::make(Input::all(), User::$editRules);

		if ($validator->fails()) {
			return Redirect::action('UserController@edit', [$user->id])->withErrors($validator);
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
		if (Input::has('experience'))
			$user->experience = Input::get('experience');
		$user->save();
		if (Input::has('voips')) {
			$voips = Input::get('voips');
			$user->voips()->sync($voips);
		}
		$user->save();
		return Redirect::action('UserController@show', [$id])->with('user', $user);

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
	 * User Resync
	 *
	 */

	public function postResync($id)
	{
		try {
			// Create SteamId Object
			$steamIdObject = new SteamId( $id );

			echo $steamIdObject->getNickname();
			// Update Info
			$user 						= User::find($id);
			$user->username 	= $steamIdObject->getNickname();
			$user->avatar 		= $steamIdObject->getFullAvatarUrl();
			$user->save();

			return Redirect::action('UserController@show', [$user->id])->with('message', 'Profile successfully resynced');
		} catch (Exception $e) {
			
			$user	= User::find($id);

			return Redirect::action('UserController@show', [$user->id])->with('message', 'Something went wrong, try again later');			
		}
	}

	/**
	 * Post Status
	 *
	 */
	public function postStatus($id)
	{
		// Get User and Inputs		
		$user = User::find($id);
		$input = Input::get();

		$user->status_id = Input::get('status');
		$user->save();

		return Redirect::action('UserController@show', [$user->id])->with('message', 'You have successfully changed your status');
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

	/**
	 * Get MyPosts
	 *
	 */
	public function getPosts($id)
	{
		// Get User
		$user = User::find($id);

		// Find Posts by this user
		$posts = Post::where('user_id', '=', $user->id)->get();

		// Find Teamposts by this user
		$teamposts = Teampost::where('user_id', '=', $user->id)->get();

		// Initialize Parsedown
		$parsedown = new Parsedown();

		//Output results to MyPosts page
		return View::make('users/myposts', compact('user', 'posts', 'teamposts', 'parsedown'));
	}
}
