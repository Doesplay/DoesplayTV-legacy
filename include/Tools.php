<?php
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
}

class Levels {
	const ADMIN = 0;
	const EDITOR = 1;
}
?>