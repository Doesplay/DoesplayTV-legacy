<?php
// Include the main class, the rest will be automatically loaded
include 'lib/dwooAutoload.php'; 
include 'include/Tools.php';
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array();

$term = '';
$result = Tools::searchDb("SELECT * FROM hosts WHERE name LIKE '%" . strtoupper($term) . "%'");

$hosts = array();

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$h = array();
		$h['name'] = $row['name'];
		$h['website'] = $row['website'];
		$h['region'] = $row['region'];
		array_push($hosts, $h);
	}
} else {
	echo "0 results";
}

// Setting to null doesn't show the notice.
$notice = null;

$data['title'] = 'Hosts';
$data['notice'] = $notice;
$data['hosts'] = $hosts;
 
// Output the result ... 
$dwoo->output('templates/hosts.html', $data);
?>