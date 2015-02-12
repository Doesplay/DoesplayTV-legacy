<?php
include '../../include/Tools.php';
include '../../include/Database.php';

$user = $_POST["user"];

$db = new Database();

$sql = "DELETE FROM users WHERE user='" . $user . "';";
$db->query($sql);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>