<?php
class Tools {
	public function getVideoId($url) {
		parse_str(parse_url($url, PHP_URL_QUERY), $id);
		return $id['v'];
	}
	
	public function searchDb($sql) {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "vods";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$result = $conn->query($sql);
		$conn->close();
		
		return $result;
	}
}
?>