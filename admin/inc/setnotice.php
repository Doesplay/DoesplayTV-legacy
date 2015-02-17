<?php
session_start();

include '../../include/Tools.php';

$content = $_POST["content"];
$enable = $_POST["enable"];
if ($enable == "on") {
	$enable = 1;
} else {
	$enable = 0;
}
$db = new Database();

$sql = "UPDATE info
		SET enabled=" . $enable . ", data='" . $content . "'
		WHERE name='notice';";

$db->query($sql);

Tools::addMessage($_SESSION['user']['user'], "edited notice: " . $content);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>