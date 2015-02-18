<?php
session_start();

include '../../include/Tools.php';

$host = $_POST["host"];
$name = $_POST["name"];
$game = $_POST["game"];
$db = new Database();

$db->query("INSERT INTO events (host, name, game)
				VALUES ('" . $host . "', '" . $name . "', '" . $game . "')");

Tools::addMessage($_SESSION['user']['user'], "added event: " . $name);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>