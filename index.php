<?php
// Include the main class, the rest will be automatically loaded
include 'lib/dwooAutoload.php'; 
include 'include/Tools.php';
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array();

// Setting to null doesn't show the notice.
$notice = "Searching only works by team at the moment!";

$data['title'] = 'CoD eSports VODs';
// content is the tag for the main content of the page.
$data['content'] = '';
$data['notice'] = $notice;
 
// Output the result ... 
$dwoo->output('templates/index.html', $data);
?>