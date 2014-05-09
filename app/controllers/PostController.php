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
    // For filter
      $region_options     = Region::lists('name', 'id');
      $rank_options       = Rank::lists('name', 'id');
      $lookingfor_options = Lookingfor::lists('name', 'id');

    // Joins
    $posts = DB::table('posts')
      ->leftJoin('users', 'posts.user_id', '=', 'users.id')
      ->leftJoin('ranks', 'users.rank_id', '=', 'ranks.id')
      ->leftJoin('regions', 'users.region_id', '=', 'regions.id')
      ->select('users.username as username',
        'users.id as userid',
        'users.avatar as avatar',
        'posts.id as id',
        'ranks.name as rank',
        'ranks.id as rankID',
        'ranks.img as rankImage',
        'regions.id as regionid',
        'regions.name as region',
        'posts.bumped_at as bumped'
      )
      ->orderBy('bumped', 'DESC')
      ->paginate(10);

    return View::make('posts/index', 
      compact('posts', 
        'region_options', 
        'rank_options', 
        'lookingfor_options'
      ));
  }

  public function postFilter()
  {
    // For filter
      $region_options     = Region::lists('name', 'id');
      $rank_options       = Rank::lists('name', 'id');
      $lookingfor_options = Lookingfor::lists('name', 'id');

      $minrank      = Input::get('minrank');
      $maxrank      = Input::get('maxrank');
      $region       = Input::get('region');
      $lookingfor   = Input::get('lookingfor');

    // Start Query for Filter
    $query = DB::table('posts')
      // Initial Joins
      ->leftJoin('users', 'posts.user_id', '=', 'users.id')
      ->leftJoin('ranks', 'users.rank_id', '=', 'ranks.id')
      ->leftJoin('regions', 'users.region_id', '=', 'regions.id')

      // Add aliases
      ->select('users.username as username',
        'users.avatar as avatar',
        'posts.id as id',
        'ranks.name as rank',
        'ranks.id as rankID',
        'ranks.img as rankImage',
        'regions.id as regionid',
        'regions.name as region',
        'posts.bumped_at as bumped'        
      )

      // Region filter
      ->where(function($query)
      {
        if(Input::get('region'))
          $query->where('regions.id', '=', Input::get('region', null));
      })

      // Rank filter
      ->where(function($query)
      {
        if(Input::get('minrank'))
        {
          if(Input::get('maxrank'))
          {
            $query->whereBetween('ranks.id', array(Input::get('minrank'), Input::get('maxrank')));
          } else
          {
            $query->where('ranks.id', '>=', Input::get('minrank'));
          }
        } 
        elseif (Input::get('maxrank'))
        {
          $query->where('ranks.id', '<=', Input::get('maxrank'));
        }
      });

    // IF lookingfor is set add Lookingfor filter
    if (Input::get('lookingfor')) {
      $query->leftJoin('lookingfor_post','posts.id', '=', 'lookingfor_post.post_id')
      
      // Lookingfor filter
      ->where('lookingfor_post.lookingfor_id', '=', Input::get('lookingfor'));
    }

    // Collect Query
    $posts = $query->orderBy('bumped', 'DESC')->paginate(10);

    //Return results
    return View::make('posts/index', 
      compact('posts', 
        'region_options', 
        'rank_options', 
        'lookingfor_options', 
        'minrank', 
        'maxrank', 
        'region', 
        'lookingfor'
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
    $user = Auth::user();
    
    if (Auth::check()) {
      if (count($user->posts) >= 1) {
        return Redirect::action('UserController@getPosts', [$user->id])->with('message', 'You already have an active post. Either <b>Bump</b>, <b>Edit</b> or <b>Remove</b> your existing post');
      } else {
        // Get user, Lookingfors, playstyles
        $user = Auth::user();
        $lookingfors = Lookingfor::all();
        $playstyles = Playstyle::all();

        // Bring to posts/create View with user details
        return View::make('posts/create', compact('user', 'lookingfors', 'playstyles'));
      }
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

      $post->bumped_at = $post->created_at;

      $post->save();


      return Redirect::action('PostController@show', [$post->id]);
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
    $parsedown = new Parsedown();

    // Get users
    $user = $post->user;
    
    // Get username and avatar
    $steam_user = $user->username;
    $steam_avatar = $user->avatar;

    // Pass statuses
    $status_options = Status::lists('name', 'id');

    // Get users ratings
    $ratings = Rating::where('user_id', $id)->get();

    return View::make('posts/show', compact('post','user', 'steam_avatar', 'steam_user', 'ratings', 'status_options', 'parsedown'));
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

      return Redirect::action('PostController@show', [$post->id]);
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

  public function bump($id)
  {
    // Get the post
    $post = Post::find($id);
    $user = Auth::user();

    // Get times
    $now = Carbon::now();
    $created_at = $post->created_at;
    $last_bumped = Carbon::createFromFormat('Y-m-d H:i:s', $post->bumped_at);

    // Check if the last bump was more that two days ago
    if($now->diffInDays($created_at) < 2 || $now->diffInDays($last_bumped) < 2)
    {
      return Redirect::action('UserController@getPosts', [$user->id])->with('message', 'You can only only bump your post once every two days');
    } else {

      // Use todays datetime to bump
      $post->bumped_at = Carbon::now();
      $post->save();

      return Redirect::to(route('posts.index').'#'.$id);
    }
  }

  public function postComment($id)
  {
    // Check if user leaving comment is logged int
    if(Auth::check()) {
      // Get post
      $post = Post::find($id);

      // Get inputs and users

      $comment = new PostComment;
      $comment->post_id   = $id;
      $comment->author_id = Auth::user()->id;
      $comment->comment   = Input::get('comment');
      $comment->save();

      return Redirect::to(route('posts.show', [$id]).'#comments');

      // Store Inputs

      // Return to post

    } else {
      return Redirect::route('posts.show', [$id])->with('message', 'You have to be logged in');
    }
  }

  public function deleteComment($id)
  {
    $post = PostComment::find($id)->post_id;
    PostComment::destroy($id);

    return Redirect::to(route('posts.show', [$post]).'#comments')->with('message', 'Successfully deleted comment');
  }

}