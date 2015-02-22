<?php
// Include the main class, the rest will be automatically loaded
include 'lib/dwooAutoload.php';
include 'include/Tools.php';

// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo();

// Create some data
$data = array();

$db = new Database();

$data['fail'] = false;
$data['listall'] = false;
$event = null;
$eventList = array();
$seriesList = array();
if (isset($_GET["id"])) {
    $event = mysqli_real_escape_string($db->getLink(), $_GET['id']);
}

// if id is a var
if (!is_null($event)) {
    $data['listall'] = false;
    $maps = array();
    $sql = "SELECT * FROM series WHERE event=" . $event;
    $result = $db->query($sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $seriesTemp = array();
            $seriesTemp['date'] = $row['date'];
            $seriesTemp['bestof'] = $row['bestof'];
            $seriesTemp['teamA'] = $row['teamA'];
            $seriesTemp['teamB'] = $row['teamB'];
            $seriesTemp['comment'] = $row['comment'];
            $seriesTemp['id'] = $row['id'];
            // Fetch host from database
            $findHost = $db->query("SELECT * FROM hosts WHERE id='" . $row['host'] . "'");
            while ($row2 = mysqli_fetch_assoc($findHost)) {
                $seriesTemp['host'] = $row2['name'];
            }
            // Fetch event name from database
            $findEvent = $db->query("SELECT * FROM events WHERE id='" . $row['event'] . "'");
            while ($row3 = mysqli_fetch_assoc($findEvent)) {
                $seriesTemp['event'] = $row3['name'];
                $seriesTemp['game'] = $row3['game'];
            }
            // Fetch map urls from database
            $findMaps = $db->query("SELECT * FROM maps WHERE series='" . $row['id'] . "'");
            while ($row4 = mysqli_fetch_assoc($findMaps)) {
                $m = array();
                $m['number'] = $row4['number'];
                $m['url'] = $row4['url'];
                $m['id'] = $row4['id'];
                $m['series'] = $row4['series'];
                array_push($maps, $m);
            }
            $seriesTemp['maps'] = $maps;
            array_push($seriesList, $seriesTemp);
        }
    } else {
        $data['fail'] = true;
    }
// no id to list, list all
} else {
    $data['listall'] = true;
    $sql = "SELECT * FROM events ORDER BY host ASC";
    $result = $db->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $eventTemp = array();
            $eventTemp['id'] = $row['id'];
            $eventTemp['name'] = $row['name'];
            $eventTemp['game'] = $row['game'];

            $sql = "SELECT * FROM hosts WHERE id=" . $row['host'];
            $result2 = $db->query($sql);
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $eventTemp['host'] = $row2['name'];
                }
            }
            array_push($eventList, $eventTemp);
        }
    }
}

$data['title'] = 'Doesplay TV: Events';
$data['eventlist'] = $eventList;
$data['serieslist'] = $seriesList;

// Output the result ... 
$dwoo->output('templates/events.html', $data);
?>