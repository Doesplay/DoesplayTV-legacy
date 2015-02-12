<?php
include '../../include/Tools.php';
include '../../include/Database.php';

$name = $_POST["user"];
$level = $_POST["level"];
$db = new Database();

$sql = "UPDATE users
		SET level=" . $level . " 
		WHERE user='" . $name . "';";
		
$db->query($sql);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>