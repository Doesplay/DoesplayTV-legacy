<?php
session_start();

include '../../include/Tools.php';

$name = $_POST["user"];
$level = $_POST["level"];
$db = new Database();

$sql = "UPDATE users
		SET level=" . $level . " 
		WHERE user='" . $name . "';";
		
$db->query($sql);

$content = $name . " -> " . $level;
Tools::addMessage($_SESSION['user']['user'], "edited user level: " . $content);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>