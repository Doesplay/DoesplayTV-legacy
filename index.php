<?php
// Include the main class, the rest will be automatically loaded
include 'lib/dwooAutoload.php'; 
include 'include/Tools.php';
include 'include/Database.php';
include 'include/Parsedown.php';
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array();

// woo database
$db = new Database();

// Parse notice Markdown so we don't have to use raw HTML
$pd = new Parsedown();

// Grab the notice
$notice = null;
$sql = "SELECT * FROM info WHERE name='notice' LIMIT 1;";
$result = $db->query($sql);
if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		if ($row['enabled'] == 1) $notice = $pd->text($row['data']);
	}
}

// Reusing vars? k.
$sql = "SELECT * FROM maps ORDER BY RAND() LIMIT 1;";
$result = $db->query($sql);

// Random map URL
$url = "https://www.youtube.com/embed/-w-58hQ9dLk";

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$longurl = $row['url'];
	}
}

$channel = "doesplay"; // temp until admin panel setting is added
$online = Tools::isStreamOnline($channel);
if ($online) {
	$data['stream'] = Tools::getStreamTitle($channel);
}
$data['channel'] = $channel;
$data['online'] = $online;

$url = "https://www.youtube.com/embed/" . Tools::getVideoId($longurl);

$data['title'] = 'Doesplay TV';
// content is the tag for the main content of the page.
$data['content'] = '';
$data['notice'] = $notice;
$data['randommap'] = $url;

// Output the result ... 
$dwoo->output('templates/index.html', $data);
?>