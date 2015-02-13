<?php
session_start();

if ($_SESSION['user']) {
	header("Location: dashboard.php");
}

// Include the main class, the rest will be automatically loaded
include '../lib/dwooAutoload.php'; 
include '../include/Tools.php';
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array();

$data['title'] = 'dpTV Admin';
// content is the tag for the main content of the page.
$data['content'] = '';

// Output the result ... 
$dwoo->output('templates/index.html', $data);
?>