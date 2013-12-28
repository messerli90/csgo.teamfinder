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
		// Authenticate with Steam (using the details from our IoC Container).
		$hybridAuthProvider = $this->hybridAuth->authenticate( "Steam" );
		
		//Authenticated
		//Lets authenticate with the core method

		//return Redirect::action('UserController@show',[Auth::user()->id])->with('user', Auth::user());

		// Get user profile information
		$hybridAuthUserProfile = $hybridAuthProvider->getUserProfile();
		// Get Community ID
		$steamCommunityId = str_replace( "http://steamcommunity.com/openid/id/", "", $hybridAuthUserProfile->identifier );
		 
		echo "Hello {$hybridAuthUserProfile->displayName}, your Steam Community ID is $steamCommunityId";
    }

}