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

$sql = "SELECT * FROM maps WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM maps ) ORDER BY id LIMIT 1;";
$db = new Database();
$result = $db->query($sql);

// Random map URL
$url = "https://www.youtube.com/embed/-w-58hQ9dLk";

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
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