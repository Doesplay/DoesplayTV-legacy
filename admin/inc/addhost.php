<?php
include '../../include/Tools.php';
include '../../include/Database.php';

$name = $_POST["name"];
$website = $_POST["website"];
$region = $_POST["region"];
$db = new Database();

$sql = "INSERT INTO hosts (name, website, region)
VALUES ('".$name."', '".$website."', '".$region."')";

$db->query($sql);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>