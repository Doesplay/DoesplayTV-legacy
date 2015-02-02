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

$link = $_GET['url'];

$id = Tools::getVideoId($link);
$url = 'https://www.youtube.com/embed/' . $id;

$map = array();
$map['teamA'] = $_GET['teamA'];
$map['teamB'] = $_GET['teamB'];
$map['bestof'] = $_GET['bestof'];
$map['event'] = $_GET['event'];
$map['host'] = $_GET['host'];
$map['date'] = $_GET['date'];
$map['num'] = $_GET['num'];
$map['comment'] = $_GET['comment'];
$map['game'] = $_GET['game'];
$map['id'] = $_GET['id'];
$map['url'] = $url;

$data['title'] = 'Map #'. $map['num'] . ' - ' . $map['teamA'] . ' vs. ' . $map['teamB'] . " - " . $map['host'] . " " . $map['event'];
// content is the tag for the main content of the page.
$data['notice'] = $notice;
$data['map'] = $map;
 
// Output the result ... 
$dwoo->output('templates/video.html', $data);
?>