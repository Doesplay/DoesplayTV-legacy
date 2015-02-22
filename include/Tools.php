<?php
include_once 'Database.php';

class Tools
{
    public function getVideoId($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $id);
        return $id['v'];
    }

    function isStreamOnline($channel)
    {
        $request = json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams/' . $channel . "?client_id=doesplaytv"));
        return (!is_null($request->stream)) ? TRUE : FALSE;
    }

    function getStreamTitle($channel)
    {
        $request = json_decode(@file_get_contents('https://api.twitch.tv/kraken/channels/' . $channel . "?client_id=doesplaytv"));
        return $request->status;
    }

    function addMessage($user, $message)
    {
        $db = new Database();
        date_default_timezone_set('Pacific/Auckland');
        $time = date("Y-m-d H:i:s");
        $sql = "INSERT INTO logs (date, user, message) VALUES ('" . $time . "', '" . $user . "', '" . $message . "')";
        $db->query($sql);
    }

    function contains($contains, $string)
    {
        return strpos($string, $contains) !== false;
    }

    function getLogColor($message)
    {
        // green = success
        // blue = info
        // yellow = warning
        // red = danger
        if (self::contains("edited user", $message) || self::contains("deleted", $message)) {
            return "danger";
        } else if (self::contains("added", $message)) {
            return "success";
        } else if (self::contains("edited notice", $message)) {
            return "warning";
        } else if (self::contains("edited ", $message)) {
            return "info";
        }
    }
}

class Levels
{
    const ADMIN = 0;
    const EDITOR = 1;
}

?>