<?php
include '../../include/Tools.php';

$date = $_POST["date"];
$bestof = $_POST["bestof"];
$host = $_POST["host"];
$event = $_POST["event"];
$teamA = $_POST["teamA"];
$teamB = $_POST["teamB"];
$comment = $_POST["comment"];
$maps = array();
array_push($maps, $_POST["map1"]);
array_push($maps, $_POST["map2"]);
array_push($maps, $_POST["map3"]);
array_push($maps, $_POST["map4"]);
array_push($maps, $_POST["map5"]);
array_push($maps, $_POST["map6"]);
array_push($maps, $_POST["map7"]);
array_push($maps, $_POST["map8"]);
array_push($maps, $_POST["map9"]);
array_push($maps, $_POST["map10"]);
array_push($maps, $_POST["map11"]);

Tools::searchDb("INSERT INTO series (date, bestof, host, event, teamA, teamB, comment) VALUES ('".$date."', '".$bestof."', '".$host."', '".$event."', '".$teamA."', '".$teamB."', '".$comment."')");

$res = Tools::searchDb("SELECT * FROM series ORDER BY id DESC LIMIT 1");
$row = $res->fetch_assoc();
$series = $row['id'];

for ($i = 0; $i <= 10; $i++) {
	$j = $i + 1;
	if ($maps[$i] != null || $maps[$i] != "") Tools::searchDb("INSERT INTO maps (number, url, series) VALUES ('".$j."', '".$maps[$i]."', '".$series."')");
}			

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>