<?php
class Tools {
	public function getVideoId($url) {
		parse_str(parse_url($url, PHP_URL_QUERY), $id);
		return $id['v'];
	}
}

class Levels {
	const ADMIN = 0;
	const EDITOR = 1;
}
?>