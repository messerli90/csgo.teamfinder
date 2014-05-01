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
		// Option for Filter
		$region_options 		= Region::lists('name', 'id');
		$skill_options 			= Skill::lists('name', 'id');
		$playstyle_options	= Playstyle::lists('name', 'id');

		// Start Query for Filter
		$teamposts = DB::table('teamposts')
			// Initial joins
			->leftJoin('regions', 'teamposts.region_id', '=', 'regions.id')
			->leftJoin('skills', 'teamposts.skill_id', '=', 'skills.id')

			// Add aliases
			->select(
				'teamposts.id as id',
				'teamposts.name as teamname',
				'teamposts.avatar as avatar',
				'regions.id as regionId',
				'regions.name as region',
				'skills.id as skillId',
				'skills.name as skill'
				)
			->orderBy('id', 'DESC')
			->paginate(10);

		// Return results
		return View::make('teamposts/index', 
			compact('teamposts', 
				'region_options', 
				'skill_options', 
				'playstyle_options'
			));
	}

	public function postFilter()
	{
		// Option for Filter
		$region_options 		= Region::lists('name', 'id');
		$skill_options 			= Skill::lists('name', 'id');
		$playstyle_options	= Playstyle::lists('name', 'id');

		// Grab Input
		$region 			= Input::get('region');
		$minskill			= Input::get('minskill');
		$maxskill			= Input::get('maxskill');
		$playstyle 		= Input::get('playstyle');

		// Start Query for Filter
		$query = DB::table('teamposts')
			// Initial joins
			->leftJoin('regions', 'teamposts.region_id', '=', 'regions.id')
			->leftJoin('skills', 'teamposts.skill_id', '=', 'skills.id')

			// Add aliases
			->select(
				'teamposts.id as id',
				'teamposts.name as teamname',
				'teamposts.avatar as avatar',
				'regions.id as regionId',
				'regions.name as region',
				'skills.id as skillId',
				'skills.name as skill'
				)

			// Region filter
      ->where(function($query)
      {
        if(Input::get('region'))
          $query->where('regions.id', '=', Input::get('region', null));
      })

      // Skill filter
      ->where(function($query)
      {
        if(Input::get('minskill'))
        {
          if(Input::get('maxskill'))
          {
            $query->whereBetween('skills.id', array(Input::get('minskill'), Input::get('maxskill')));
          } else
          {
            $query->where('skills.id', '>=', Input::get('minskill'));
          }
        } 
        elseif (Input::get('maxskill'))
        {
          $query->where('skills.id', '<=', Input::get('maxskill'));
        }
      });

      // IF playstyle is set add Playstyle filter
      if (Input::get('playstyle')) {
      	// Join playstyle_teampost
      	$query->leftJoin('playstyle_teampost', 'teamposts.id', '=', 'playstyle_teampost.teampost_id')

      	// Playstyle filter
      	->where('playstyle_teampost.playstyle_id', '=', Input::get('playstyle'));
      }

      // Collect Query
      $teamposts = $query->orderBy('id', 'DESC')->paginate(10);

      // Return results
   		return View::make('teamposts/index', 
   			compact('teamposts', 
   				'region_options', 
   				'skill_options', 
   				'playstyle_options', 
   				'region', 
   				'minskill', 
   				'maxskill', 
   				'playstyle'
   			));

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
			if (Input::has('teamavatar')) {
				$teampost->avatar 		= Input::get('teamavatar');
			} else {
				$teampost->avatar 		= "http://csgoteamfinder.com/img/teamposts/default.png";
			}
			$teampost->website			= Input::get('teamwebsite');
			$teampost->steamgroup		= Input::get('steamgroup');
			$teampost->region_id		= Input::get('region_id');
			$teampost->skill_id			= Input::get('skill_id');
			$teampost->language 		= Input::get('language');
			$teampost->league				= Input::get('league');
			$teampost->info 				= Input::get('info');
			$playstyles							= Input::get('playstyles');
				$teampost->playstyles()->sync($playstyles);
			$lookingfors						= Input::get('lookingfors');
				$teampost->lookingfors()->sync($lookingfors);

			$teampost->save();

			return Redirect::route('teamposts.show', [$teampost->id])->with('message', 'Post added');
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
		$post = Teampost::find($id);
		$parsedown = new Parsedown();

		// Get users
		$user = $post->user;

		// Get users ratings

		return View::make('teamposts/show', compact('post','user', 'parsedown'));
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
		$post = Teampost::find($id);
		$lookingfors = Lookingfor::all();
		$playstyles = Playstyle::all();
		$region_options = Region::lists('name', 'id');
		$skill_options = Skill::lists('name', 'id');

		if (Auth::user()) {
			if ($user->id == $post->user->id) {
				return View::make('teamposts/edit', compact('user', 'post', 'lookingfors', 'playstyles', 'region_options', 'skill_options'));
			}
		} return Redirect::route('teamposts.index')->with('message', 'You can only edit your own post');
		return Redirect::route('teamposts.index')->with('message', 'You must be logged in to edit a post');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Teampost::$teampostRules, Teampost::$errorMessages);

		// Check if validator passes
		if($validator->fails()) 
		{
			// Redirect back to users/create with errors
			return Redirect::route('teamposts.edit', [$id])->withErrors($validator)->withInput();
		} else {
			// Get user
			$user = Auth::user();

			// Get Post
			$post = Teampost::find($id);
			
			// Associate User to Post
			$post = $user->teamposts()->save($post);
			
			// Get inputs
			$post->name 				= Input::get('teamname');
			
			if (Input::has('teamavatar')) {
				$post->avatar 		= Input::get('teamavatar');
			} else {
				$post->avatar 		= "http://csgoteamfinder.com/img/teamposts/default.png";
			}

			$post->website			= Input::get('teamwebsite');
			$post->steamgroup		= Input::get('steamgroup');
			$post->region_id		= Input::get('region_id');
			$post->skill_id			= Input::get('skill_id');
			$post->language 		= Input::get('language');
			$post->league				= Input::get('league');
			$post->info 				= Input::get('info');
			$playstyles							= Input::get('playstyles');
				$post->playstyles()->sync($playstyles);
			$lookingfors						= Input::get('lookingfors');
				$post->lookingfors()->sync($lookingfors);

			$post->save();

			return Redirect::to(route('teamposts.index').'#'.$post->id.'id');
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
		Teampost::destroy($id);

		return Redirect::route('teamposts.index')->with('message', 'Successfully deleted post');
	}

	public function postComment($id)
	{
		// Check if user leaving comment is logged int
		if(Auth::check()) {
			// Get post
			$post = Teampost::find($id);

			// Get inputs and users

			$comment = new TeampostComment;
			$comment->teampost_id 	= $id;
			$comment->author_id 		= Auth::user()->id;
			$comment->comment 			= Input::get('comment');
			$comment->save();

			return Redirect::to(route('teamposts.show', [$id]).'#comments');


			// Return to post

		} else {
			return Redirect::route('teamposts.show', [$id])->with('message', 'You have to be logged in');
		}
	}

	public function deleteComment($id)
	{
		$post = TeampostComment::find($id)->teampost_id;
		TeampostComment::destroy($id);

		return Redirect::to(route('teamposts.show', [$post]).'#comments')->with('message', 'Successfully deleted comment');
	}

}