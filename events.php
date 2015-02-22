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
if (isset($_GET["id"])) {
    $event = mysqli_real_escape_string($db->getLink(), $_GET['id']);
}

// if id is a var
if (!is_null($event)) {
    $sql = "SELECT * FROM events WHERE id=" . $event;
    $result = $db->query($sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {

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

// Output the result ... 
$dwoo->output('templates/events.html', $data);
?>