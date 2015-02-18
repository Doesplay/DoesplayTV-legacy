<?php
session_start();

include '../../include/Tools.php';

$db = new Database();

$date = $_POST["date"];
$bestof = $_POST["bestof"];
$raw = explode(',', $_POST['event']);
$host = $raw[0];
$event = $raw[1];
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

$db->query("INSERT INTO series (date, bestof, host, event, teamA, teamB, comment) VALUES ('" . $date . "', '" . $bestof . "', '" . $host . "', '" . $event . "', '" . $teamA . "', '" . $teamB . "', '" . $comment . "')");

$res = $db->query("SELECT * FROM series ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_assoc($res);
$series = $row['id'];

for ($i = 0; $i <= 10; $i++) {
    $j = $i + 1;
    if ($maps[$i] != null || $maps[$i] != "") $db->query("INSERT INTO maps (number, url, series) VALUES ('" . $j . "', '" . $maps[$i] . "', '" . $series . "')");
}

$content = $teamA . " vs. " . $teamB . " - " . $date;
Tools::addMessage($_SESSION['user']['user'], "added series: " . $content);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>