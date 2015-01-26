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

// Random map URL
$url = "https://www.youtube.com/embed/-w-58hQ9dLk";
$sql = "SELECT * FROM maps WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM maps ) ORDER BY id LIMIT 1;";
$result = Tools::searchDb($sql);
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$longurl = $row['url'];
	}
}
$url = "https://www.youtube.com/embed/" . Tools::getVideoId($longurl);

$data['title'] = 'CoD eSports VODs';
// content is the tag for the main content of the page.
$data['content'] = '';
$data['notice'] = $notice;
$data['randommap'] = $url;

// Output the result ... 
$dwoo->output('templates/index.html', $data);
?>