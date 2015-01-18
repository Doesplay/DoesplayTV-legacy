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

$game = $_GET["game"];
$id = Tools::getVideoId($_GET["video"]);
$url = 'https://www.youtube.com/embed/' . $id;

$data['title'] = 'VOD: ' . $game;
$data['game'] = $game;
// content is the tag for the main content of the page.
$data['content'] = $url;
$data['notice'] = $notice;
 
// Output the result ... 
$dwoo->output('templates/video.html', $data);
?>