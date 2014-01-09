<?php
class SteamController extends \BaseController {
 
 	public function __construct(Hybrid_Auth $hybridAuth)
    {
        $this->hybridAuth = $hybridAuth;
    }

    public function login($action='')
    {
		if ( $action == "auth" ) {
		  try {
		     Hybrid_Endpoint::process();
		  }
		  catch ( Exception $e ) {
		     echo "Error at Hybrid_Endpoint process (SteamController@login): $e";
		  }
		  return;
		}
		$steamCommunityId = 0;
		// Authenticate with Steam (using the details from our IoC Container).
		$hybridAuthProvider = $this->hybridAuth->authenticate( "Steam" );
		
		// Get user profile information
		$hybridAuthUserProfile = $hybridAuthProvider->getUserProfile();
		// Get Community ID
		$steamCommunityId = str_replace( "http://steamcommunity.com/openid/id/", "", $hybridAuthUserProfile->identifier );
		//See if they have a user yet
		$user = DB::table('users')->where('steamid', $steamCommunityId)->first();


		
		if($steamCommunityId != 0 && $user != null) {
			//If they are still authenticated just send them straight back to the edit Page
			Auth::loginUsingId($user->id);
			return Redirect::action('UserController@show', [$user->id])->with('message', 'You are still authenticated with steam, sending you to the edit page');
		} else {
			//Create a new user with their steam id
			$user = new User;
			$user->username = 'SteamID&nbsp;'.$steamCommunityId;
			$user->email = $steamCommunityId;
			$user->steamid = $steamCommunityId;
			$user->steamdisplay = $hybridAuthUserProfile->extraInfo["steamID"];
			$user->save();

			Auth::login($user);
			//Log them in manually then redirect user to Edit Profile Page
			return Redirect::action('UserController@edit', [$user->id])->with('message', 'Thank you for registering! Be sure to complete your profile.');
		}

    }

}