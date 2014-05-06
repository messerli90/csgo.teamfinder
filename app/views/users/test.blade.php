
<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>

<?php
		$api = '165D8028998190216552CABB266E9A50';
		$steamid = '76561197982623132';

	$steam_json = file_get_contents("http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=$api&steamid=$steamid");
	$steam_data = json_decode($steam_json, true);
?>

{{ $steam_json }}

<!--
{
	"response": {
		"players": [
			{
				"steamid": "76561197982623132",
				"communityvisibilitystate": 3,
				"profilestate": 1,
				"personaname": "kniFely™CH",
				"lastlogoff": 1389125518,
				"commentpermission": 1,
				"profileurl": "http://steamcommunity.com/id/knifely/",
				"avatar": "http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fe1b7b5d0adccca90ed6a1af0c6cd8a60eb141a5.jpg",
				"avatarmedium": "http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fe1b7b5d0adccca90ed6a1af0c6cd8a60eb141a5_medium.jpg",
				"avatarfull": "http://media.steampowered.com/steamcommunity/public/images/avatars/fe/fe1b7b5d0adccca90ed6a1af0c6cd8a60eb141a5_full.jpg",
				"personastate": 4,
				"realname": "Mike",
				"primaryclanid": "103582791434489067",
				"timecreated": 1147635935,
				"personastateflags": 0,
				"loccountrycode": "CH",
				"locstatecode": "05",
				"loccityid": 9362
			}
		]
		
	}
}
-->

</body>
</html>


