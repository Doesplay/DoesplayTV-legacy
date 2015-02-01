<?php
include '../../include/Tools.php';

$name = $_POST["name"];
$website = $_POST["website"];
$region = $_POST["region"];

$sql = "INSERT INTO hosts (name, website, region)
VALUES ('".$name."', '".$website."', '".$region."')";

Tools::searchDB($sql);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>