<?php
session_start();

include '../../include/Tools.php';

$name = $_POST["name"];
$website = $_POST["website"];
$region = $_POST["region"];
$db = new Database();

$sql = "INSERT INTO hosts (name, website, region)
VALUES ('" . $name . "', '" . $website . "', '" . $region . "')";

$db->query($sql);

Tools::addMessage($_SESSION['user']['user'], "added host: " . $name);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>