<?php
include '../lib/dwooAutoload.php'; 
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array();

// Output the result ... 
$h = $dwoo->get('templates/notice.html', $data);

$arr = array('html' => $h);
echo json_encode($arr);
?>