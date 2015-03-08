<?php
session_start();

include '../../include/Tools.php';

$stream = $_POST["stream"];
$enabled = $_POST["enabled"];
$db = new Database();

$sql = "UPDATE streams
		SET enabled=" . $enabled . "
		WHERE stream='" . $stream . "';";

$db->query($sql);

$e = (intval($enabled) == 0 ? "disabled" : "enabled");
$content = $stream . " -> " . $e;
Tools::addMessage($_SESSION['user']['user'], "edited stream: " . $content);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>