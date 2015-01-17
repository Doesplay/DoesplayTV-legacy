<?php
class Tools {
	public function getVideoId($url) {
		preg_match(
        '/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
		
		return $matches[1];
	}
}
?>