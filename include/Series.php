<?php
class Series {
	// Unique IDs from database
	private $host;
	private $event;
	private $teamA;
	private $teamB;
	// Default to 5, why not
	private $bestOf = 5;
	private $mapCount;
	private $maps = $array();
	
	function __construct($host, $event, $teamA, $teamB, $bestOf, $mapCount) {
		$this->host = $host;
		$this->event = $event;
		$this->teamA = $teamA;
		$this->teamB = $teamB;
		$this->bestOf = $bestOf;
		$this->mapCount = $mapCount;
		
		// Untested, hopefully works idk
		for ($i = 1; $i <= $mapCount; $i++) {
			$this->maps[$i] = "";
		}
	}
}

?>