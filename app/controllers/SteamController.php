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
		$user = DB::table('steamusers')->where('id', $steamCommunityId)->first();
		//$user = Steamuser::find($steamCommunityId);

		// Create SteamId Object
		$steamIdObject = new SteamId( "$steamCommunityId" );

		// Check DB 
		if($user != null) {
			// Update Info
			$user = Steamuser::find($steamCommunityId);
			$user->username 	= $steamIdObject->getNickname();
			$user->avatar 		= $steamIdObject->getIconAvatarUrl();
			$user->save();

			// Create Session
			Session::put('steam_session', $steamCommunityId);

			// If the user exists in the DB sign in and return to profile
			return Redirect::action('UserController@show', [$user->id])->with('message', 'You have successfully logged in');

		} else {
			// Create a new user
			$user = new Steamuser;
			$user->id 			= $steamCommunityId;
			$user->username 	= $steamIdObject->getNickname();
			$user->avatar 		= $steamIdObject->getIconAvatarUrl();
			$user->save();

			// Create Session
			Session::put('steam_session', $steamCommunityId);

			// Log user in manually and redirect to Edit page
			return Redirect::action('UserController@edit', [$user->id])->with('message', 'Thank you for registering. Be sure to complete your profile.');
		}

		 

	}

	public function logout()
	{
		// Logout
		$this->hybridAuth->logoutAllProviders();

		// Flush Session
		Session::flush();

		return Redirect::action('HomeController@showWelcome');
	}
}