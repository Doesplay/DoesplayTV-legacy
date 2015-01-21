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

$teamA = $_POST['teamA'];
$teamB = $_POST['teamB'];
$bestof = $_POST['bestof'];
$event = $_POST['event'];
$host = $_POST['host'];

$sql = "INSERT INTO series (bestof, host, event, teamA, teamB)
VALUES ('".$bestof.", '".$host.", '".$event.", '".$teamA.", '".$teamB", ')"

$series = array();
$maps = array();

$data['title'] = 'CoD eSports VODs';
// content is the tag for the main content of the page.
$data['content'] = '';
$data['notice'] = $notice;
$data['series'] = $series;
$data['maps'] = $maps;

// Output the result ... 
$dwoo->output('templates/insert.html', $data);
?>