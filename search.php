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

$result = Tools::searchDb("SELECT * FROM series WHERE teamA LIKE '%" . $term . "%'");

$series = array();

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$h = array();
		$h['date'] = $row['date'];
		$h['bestof'] = $row['bestof'];
		$h['teamA'] = $row['teamA'];
		$h['teamB'] = $row['teamB'];
		$findHost = Tools::searchDb("SELECT * FROM hosts WHERE id='".$row['host']."'");
		while($row2 = $findHost->fetch_assoc()) {
			$h['host'] = $row2['name'];
		}
		$findEvent = Tools::searchDb("SELECT * FROM events WHERE id='".$row['event']."'");
		while($row3 = $findEvent->fetch_assoc()) {
			$h['event'] = $row3['name'];
		}
		array_push($series, $h);
	}
} else {
	echo "0 results";
}

$data['title'] = 'CoD eSports VODs';
// content is the tag for the main content of the page.
$data['content'] = '';
$data['notice'] = $notice;
$data['series'] = $series;

// Output the result ... 
$dwoo->output('templates/search.html', $data);
?>