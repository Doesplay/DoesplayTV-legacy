<?php
session_start();

if (empty($_SESSION['user'])) {
	die("Must login.");
}

// Include the main class, the rest will be automatically loaded
include '../lib/dwooAutoload.php'; 
include '../include/Tools.php';
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array();

$data['title'] = 'dpTV Admin';
$data['level'] = $_SESSION['user']['level'];

// Output the result ... 
$dwoo->output('templates/dashboard.html', $data);
?>