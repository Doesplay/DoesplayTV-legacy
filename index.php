<?php
// Include the main class, the rest will be automatically loaded
include 'lib/dwooAutoload.php'; 
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array();

// Setting to null doesn't show the notice.
$notice = 'Coming soon.';

$data['title'] = 'CoD eSports VODs';
// content is the tag for the main content of the page.
$data['content'] = '';
$data['notice'] = $notice;
 
// Output the result ... 
$dwoo->output('templates/main.html', $data);
?>