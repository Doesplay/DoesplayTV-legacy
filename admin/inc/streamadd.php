<?php
session_start();

include '../../include/Tools.php';

$stream = $_POST["url"];
$db = new Database();

$sql = "SELECT 1 FROM streams WHERE stream='" . $stream . "';";
$res = $db->query($sql);
if (mysqli_num_rows($res) > 0) {
    die("Stream already exists.");
} else {
    $sql = "INSERT INTO streams (stream, enabled)
			VALUES ('" . $stream . "', '0')";

    $db->query($sql);

    Tools::addMessage($_SESSION['user']['user'], "added stream: " . $stream);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>