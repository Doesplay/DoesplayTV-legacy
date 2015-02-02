<?php
// Include the main class, the rest will be automatically loaded
include 'lib/dwooAutoload.php'; 
include 'include/Tools.php';
include 'include/Database.php';
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array();

// Setting to null doesn't show the notice.
$notice = null;

$db = new Database();
$map = array();

$mapId = mysqli_real_escape_string($db->getLink(), $_GET['id']);
$map['id'] = $mapId;

$sql = "SELECT * FROM maps WHERE id=" . $mapId;
$result = $db->query($sql);

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$seriesId = $row['series'];
		$map['num'] = $row['number'];
		$map['url'] = 'https://www.youtube.com/embed/' . Tools::getVideoId($row['url']);
		
		$sql = "SELECT * FROM series WHERE id=" . $seriesId;
		$seriesRes = $db->query($sql);
		while($series = mysqli_fetch_assoc($seriesRes)) {
			$map['teamA'] = $series['teamA'];
			$map['teamB'] = $series['teamB'];
			$map['bestof'] = $series['bestof'];
			// get event name
			$sql = "SELECT * FROM events WHERE id=" . $series['event'];
			$eventRes = $db->query($sql);
			if (mysqli_num_rows($eventRes) > 0) {
				// output data of each row
				while($eRow = mysqli_fetch_assoc($eventRes)) {
					$map['event'] = $eRow['name'];
				}
			}
			// get host name
			$sql = "SELECT * FROM hosts WHERE id=" . $series['host'];
			$hostRes = $db->query($sql);
			if (mysqli_num_rows($hostRes) > 0) {
				// output data of each row
				while($hRow = mysqli_fetch_assoc($hostRes)) {
					$map['host'] = $hRow['name'];
				}
			}
			$map['date'] = $series['date'];
			$map['comment'] = $series['comment'];
		}
	}
} else {
	die("Map doesn't exist! ):");
}

$data['title'] = 'Map #'. $map['num'] . ' - ' . $map['teamA'] . ' vs. ' . $map['teamB'] . " - " . $map['host'] . " " . $map['event'];
// content is the tag for the main content of the page.
$data['notice'] = $notice;
$data['map'] = $map;
 
// Output the result ... 
$dwoo->output('templates/video.html', $data);
?>