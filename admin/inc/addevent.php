<?php
include '../../include/Tools.php';
include '../../include/Database.php';

$host = $_POST["host"];
$name = $_POST["name"];
$game = $_POST["game"];
$db = new Database();

$db->query("INSERT INTO events (host, name, game)
				VALUES ('".$host."', '".$name."', '".$game."')");
				
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>