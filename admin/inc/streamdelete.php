<?php
session_start();

include '../../include/Tools.php';

$stream = $_POST["stream"];

$db = new Database();

$sql = "DELETE FROM streams WHERE stream='" . $stream . "';";
$db->query($sql);

Tools::addMessage($_SESSION['user']['user'], "deleted stream: " . $stream);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>