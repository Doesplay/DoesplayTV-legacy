<?php
include '../../include/Tools.php';

$user = $_POST["user"];
$password = $_POST["password"];

$db = new Database();

$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
$pass = hash('sha256', $password . $salt);
for ($round = 0; $round < 65536; $round++) {
    $pass = hash('sha256', $pass . $salt);
}

$sql = "UPDATE users
		SET password='" . $pass . "', salt='" . $salt . "'
		WHERE user='" . $user . "';";
$db->query($sql);

Tools::addMessage($_SESSION['user']['user'], "edited user password: " . $user);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>