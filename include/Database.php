<?php

class Database
{
    private $connection = null;

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "vods";

    function __construct()
    {
        // Create connection
        $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function query($sql)
    {
        $result = mysqli_query($this->connection, $sql);

        return $result;
    }

    public function getLink()
    {
        return $this->connection;
    }

    public function close()
    {
        mysqli_close($this->connection);
    }

    function __destruct()
    {
        $this->close();
    }
}

?>