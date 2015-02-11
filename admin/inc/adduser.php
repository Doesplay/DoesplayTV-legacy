<?php
include '../../include/Tools.php';
include '../../include/Database.php';

$name = $_POST["name"];
$password = $_POST["password"];
$confirmpass = $_POST["confirmpass"];
if ($password != $confirmpass) {
	die("Passwords don't match.");
}
$level = $_POST["level"];
$db = new Database();

$sql = "SELECT 1 FROM users WHERE user='" . $name . "';";
$res = $db->query($sql);
if (mysqli_num_rows($res) > 0) {
	die("User already exists.");
} else {
	$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
    $pass = hash('sha256', $password . $salt);
    for($round = 0; $round < 65536; $round++){
		$pass = hash('sha256', $pass . $salt);
	}
	
	$sql = "INSERT INTO users (user, password, salt, level)
			VALUES ('".$name."', '".$pass."', '".$salt."', '".$level."')";
			
	$db->query($sql);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>