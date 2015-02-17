<?php
session_start();

include '../../include/Tools.php';

$user = $_POST["user"];

$db = new Database();

$sql = "DELETE FROM users WHERE user='" . $user . "';";
$db->query($sql);

Tools::addMessage($_SESSION['user']['user'], "deleted user: " . $user);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>