<?php

class TeampostController extends \BaseController {

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
		$teamposts = Teampost::with('user', 'region', 'playstyles', 'lookingfors', 'teampostcomments')->orderBy('id', 'DESC')->paginate(10);
		return View::make('teamposts/index', compact('teamposts'));
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
			// Get info
			$user = Auth::user();
			$lookingfors = Lookingfor::all();
			$playstyles = Playstyle::all();
			$region_options = Region::lists('name', 'id');
			$skill_options = Skill::lists('name', 'id');
			
			// Bring to posts/create View with user details
			return View::make('teamposts/create', compact('user', 'lookingfors', 'playstyles', 'region_options', 'skill_options'));

		} else {
			// If not authenticated bring to register view
			return Redirect::action('TeampostController@index')->with('message', 'You must be logged in to make a post');
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
		$validator = Validator::make(Input::all(), Teampost::$teampostRules, Post::$errorMessages);

		// Check if validator passes
		if($validator->fails()) 
		{
			// Redirect back to users/create with errors
			return Redirect::route('teamposts.create')->withErrors($validator)->withInput();
		} else {
			if (Auth::check()) {
				// Get user
				$user = Auth::user();
			}

			// Make new Teampost
			$teampost = new Teampost;

			// Associate User to Post
			$teampost = $user->teamposts()->save($teampost);

			// Get inputs
			$teampost->name 				= Input::get('teamname');
			$teampost->avatar 			= Input::get('teamavatar');
			$teampost->language 		= Input::get('language');
			$teampost->website			= Input::get('teamwebsite');
			$teampost->steamgroup		= Input::get('steamgroup');
			$teampost->region_id		= Input::get('region_id');
			$teampost->skill_id			= Input::get('skill_id');
			$teampost->league				= Input::get('league');
			$playstyles					= Input::get('playstyles');
				$teampost->playstyles()->sync($playstyles);
			$lookingfors				= Input::get('lookingfors');
				$teampost->lookingfors()->sync($lookingfors);

			$teampost->save();

			return Redirect::to_route('teamposts.index')->with('message', 'Post added');
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
		//
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
		//
	}

}