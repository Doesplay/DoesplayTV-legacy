<?php
include '../../include/Tools.php';

$host = $_POST["host"];
$name = $_POST["name"];

Tools::searchDb("INSERT INTO events (host, name)
				VALUES ('".$host."', '".$name."')");
				
echo "ok";
?>