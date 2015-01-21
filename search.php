<?php
// Include the main class, the rest will be automatically loaded
include 'lib/dwooAutoload.php'; 
include 'include/Tools.php';
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array();

// Setting to null doesn't show the notice.
$notice = null;

$term = null;

if ($_POST["query"]) {
	$term = $_POST['query'];
}

$sql = "SELECT * FROM series WHERE teamA LIKE '%" . $term . "%' OR teamB LIKE '%" . $term . "%'";
//$sql .= " ORDER BY date DESC";
//$sql .= " UNION ALL";
//$sql .= " SELECT * FROM hosts WHERE name LIKE '%" . $term . "%'";

$result = Tools::searchDb($sql);

$series = array();
$maps = array();

$fail = 0;

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$seriesTemp = array();
		$seriesTemp['date'] = $row['date'];
		$seriesTemp['bestof'] = $row['bestof'];
		$seriesTemp['teamA'] = $row['teamA'];
		$seriesTemp['teamB'] = $row['teamB'];
		$seriesTemp['comment'] = $row['comment'];
		$seriesTemp['id'] = $row['id'];
		// Fetch host from database
		$findHost = Tools::searchDb("SELECT * FROM hosts WHERE id='".$row['host']."'");
		while($row2 = $findHost->fetch_assoc()) {
			$seriesTemp['host'] = $row2['name'];
		}
		// Fetch event name from database
		$findEvent = Tools::searchDb("SELECT * FROM events WHERE id='".$row['event']."'");
		while($row3 = $findEvent->fetch_assoc()) {
			$seriesTemp['event'] = $row3['name'];
		}
		// Fetch map urls from database
		$findMaps = Tools::searchDb("SELECT * FROM maps WHERE series='".$row['id']."'");
		while($row4 = $findMaps->fetch_assoc()) {
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

$data['title'] = 'CoD eSports VODs';
// content is the tag for the main content of the page.
$data['content'] = '';
$data['notice'] = $notice;
$data['series'] = $series;
$data['maps'] = $maps;
$data['fail'] = $fail;

// Output the result ... 
$dwoo->output('templates/search.html', $data);
?>