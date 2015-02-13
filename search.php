<?php
// Include the main class, the rest will be automatically loaded
include 'lib/dwooAutoload.php'; 
include 'include/Database.php';
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array();

$team = null;
$host = null;
$event = null;
if ($_POST["team"]) {
	$team = trim($_POST['team']);
}
if ($_POST["event"]) {
	$raw = explode(',', $_POST['event']);
	$host = $raw[0];
	$event = $raw[1];
}

$db = new Database();

$sql = "SELECT series.* FROM series
		JOIN events ON series.event=events.id
		JOIN hosts on events.host=hosts.id
			WHERE (series.teamA LIKE '%" . $team . "%' OR series.teamB LIKE '%" . $team . "%') AND events.id=" . $event . " AND hosts.id=" . $host;

$result = $db->query($sql);

$series = array();
$maps = array();

$fail = 0;

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$seriesTemp = array();
		$seriesTemp['date'] = $row['date'];
		$seriesTemp['bestof'] = $row['bestof'];
		$seriesTemp['teamA'] = $row['teamA'];
		$seriesTemp['teamB'] = $row['teamB'];
		$seriesTemp['comment'] = $row['comment'];
		$seriesTemp['id'] = $row['id'];
		// Fetch host from database
		$findHost = $db->query("SELECT * FROM hosts WHERE id='".$row['host']."'");
		while($row2 = mysqli_fetch_assoc($findHost)) {
			$seriesTemp['host'] = $row2['name'];
		}
		// Fetch event name from database
		$findEvent = $db->query("SELECT * FROM events WHERE id='".$row['event']."'");
		while($row3 = mysqli_fetch_assoc($findEvent)) {
			$seriesTemp['event'] = $row3['name'];
			$seriesTemp['game'] = $row3['game'];
		}
		// Fetch map urls from database
		$findMaps = $db->query("SELECT * FROM maps WHERE series='".$row['id']."'");
		while($row4 = mysqli_fetch_assoc($findMaps)) {
			$m = array();
			$m['number'] = $row4['number'];
			$m['url'] = $row4['url'];
			$m['id'] = $row4['id'];
			$m['series'] = $row4['series'];
			array_push($maps, $m);
		}
		$seriesTemp['maps'] = $maps;
		array_push($series, $seriesTemp);
	}
} else {
	$fail = 1;
}

$data['title'] = 'Doesplay TV';
$data['series'] = $series;
$data['maps'] = $maps;
$data['fail'] = $fail;

// Output the result ... 
$dwoo->output('templates/search.html', $data);
?>