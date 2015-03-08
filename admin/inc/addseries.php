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
array_push($maps, array("url" => $_POST["map1"], "type" => $_POST["map1type"]));
array_push($maps, array("url" => $_POST["map2"], "type" => $_POST["map2type"]));
array_push($maps, array("url" => $_POST["map3"], "type" => $_POST["map3type"]));
array_push($maps, array("url" => $_POST["map4"], "type" => $_POST["map4type"]));
array_push($maps, array("url" => $_POST["map5"], "type" => $_POST["map5type"]));
array_push($maps, array("url" => $_POST["map6"], "type" => $_POST["map6type"]));
array_push($maps, array("url" => $_POST["map7"], "type" => $_POST["map7type"]));
array_push($maps, array("url" => $_POST["map8"], "type" => $_POST["map8type"]));
array_push($maps, array("url" => $_POST["map9"], "type" => $_POST["map9type"]));
array_push($maps, array("url" => $_POST["map10"], "type" => $_POST["map10type"]));
array_push($maps, array("url" => $_POST["map11"], "type" => $_POST["map11type"]));

$db->query("INSERT INTO series (date, bestof, host, event, teamA, teamB, comment) VALUES ('" . $date . "', '" . $bestof . "', '" . $host . "', '" . $event . "', '" . $teamA . "', '" . $teamB . "', '" . $comment . "')");

$res = $db->query("SELECT * FROM series ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_assoc($res);
$series = $row['id'];

for ($i = 0; $i <= 10; $i++) {
    $j = $i + 1;
    if ($maps[$i]['url'] != null || $maps[$i]['url'] != "")
    {
        $db->query("INSERT INTO maps (number, url, series, type) VALUES ('" . $j . "', '" . $maps[$i]['url'] . "', '" . $series . "', '" . $maps[$i]['type'] . "')");
    }
}

$content = $teamA . " vs. " . $teamB . " - " . $date;
Tools::addMessage($_SESSION['user']['user'], "added series: " . $content);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>