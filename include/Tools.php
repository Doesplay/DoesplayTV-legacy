<?php
include_once 'Database.php';

class Tools {
	public function getVideoId($url) {
		parse_str(parse_url($url, PHP_URL_QUERY), $id);
		return $id['v'];
	}
	
	function isStreamOnline($channel) {
		$request = json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams/' . $channel . "?client_id=doesplaytv"));
		return (! is_null($request->stream)) ? TRUE : FALSE;
	}

	function getStreamTitle($channel) {
		$request = json_decode(@file_get_contents('https://api.twitch.tv/kraken/channels/' . $channel . "?client_id=doesplaytv"));
		return $request->status;
	}
	
	function addMessage($user, $message) {
		$db = new Database();
		date_default_timezone_set('Pacific/Auckland');
		$time = date("Y-m-d H:i:s");
		$sql = "INSERT INTO logs (date, user, message) VALUES ('".$time."', '".$user."', '".$message."')";
		$db->query($sql);
	}
}

class Levels {
	const ADMIN = 0;
	const EDITOR = 1;
}
?>