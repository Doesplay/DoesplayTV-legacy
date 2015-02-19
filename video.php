<?php
// Include the main class, the rest will be automatically loaded
include 'lib/dwooAutoload.php';
include 'include/Tools.php';

// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo();

// Create some data
$data = array();

$db = new Database();
$map = array();

$mapId = mysqli_real_escape_string($db->getLink(), $_GET['id']);
$map['id'] = $mapId;

$sql = "SELECT * FROM maps WHERE id=" . $mapId;
$result = $db->query($sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $seriesId = $row['series'];
        $map['num'] = $row['number'];
        $map['url'] = 'https://www.youtube.com/embed/' . Tools::getVideoId($row['url']);

        $sql = "SELECT * FROM series WHERE id=" . $seriesId;
        $seriesRes = $db->query($sql);
        while ($series = mysqli_fetch_assoc($seriesRes)) {
            $map['teamA'] = $series['teamA'];
            $map['teamB'] = $series['teamB'];
            $map['bestof'] = $series['bestof'];
            // get event name
            $sql = "SELECT * FROM events WHERE id=" . $series['event'];
            $eventRes = $db->query($sql);
            if (mysqli_num_rows($eventRes) > 0) {
                // output data of each row
                while ($eRow = mysqli_fetch_assoc($eventRes)) {
                    $map['event'] = $eRow['name'];
                }
            }
            // get host name
            $sql = "SELECT * FROM hosts WHERE id=" . $series['host'];
            $hostRes = $db->query($sql);
            if (mysqli_num_rows($hostRes) > 0) {
                // output data of each row
                while ($hRow = mysqli_fetch_assoc($hostRes)) {
                    $map['host'] = $hRow['name'];
                }
            }
            $map['date'] = $series['date'];
            $map['comment'] = $series['comment'];
        }
    }
} else {
    die("Map doesn't exist! ):");
}

$maps = array();
$findMaps = $db->query("SELECT * FROM maps WHERE series='" . $seriesId . "'");
while ($row4 = mysqli_fetch_assoc($findMaps)) {
    $m = array();
    $m['number'] = $row4['number'];
    $m['url'] = 'https://www.youtube.com/embed/' . Tools::getVideoId($row4['url']);
    $m['id'] = $row4['id'];
    $m['series'] = $row4['series'];
    array_push($maps, $m);
}
$data['maps'] = $maps;

$data['title'] = 'Map #' . $map['num'] . ' - ' . $map['teamA'] . ' vs. ' . $map['teamB'] . " - " . $map['host'] . " " . $map['event'];
$data['map'] = $map;

// Output the result ... 
$dwoo->output('templates/video.html', $data);
?>