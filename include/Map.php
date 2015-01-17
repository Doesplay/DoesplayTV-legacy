<?php
class Map {
	// Unique identifier? Name? idk yet
	private $series = '';
	// Map name
	private $name = '';
	// Gamemode
	private $mode = '';
	// URL to VOD for embedding
	private $url = '';
	
	function __construct($series, $name, $mode) {
		$this->series = $series;
		$this->name = $name;
		$this->mode = $mode;
	}

	// Returns the series name/identifier
	public function getSeries() {
        return $this->series;
    }
	
	// Sets the series name/identifier
	public function setSeries($series) {
        $this->series = $series;
    }
	
	// Returns the map name
    public function getName() {
        return $this->name;
    }
	
	// Sets the map name
    public function setName($name) {
        $this->name = $name;
    }
	
	// Returns the gamemode
	public function getMode() {
        return $this->mode;
    }
	
	// Sets the gamemode
	public function setMode() {
        $this->mode = $mode;
    }
	
	// Returns the VOD URL
	public function getUrl() {
        return $this->url;
    }
	
	// Sets the VOD URL
	public function setURL($url) {
		$this->url = $url;
	}
}
?>