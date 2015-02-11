<?php
session_start();

include '../include/Database.php';

$ok = false;

$db = new Database();

$sql = "SELECT id,user,password,salt,level FROM users WHERE user='" . $_POST['user'] . "';";

$result = $db->query($sql);

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$password = hash('sha256', $_POST['password'] . $row['salt']); 
        for ($round = 0; $round < 65536; $round++){
            $password = hash('sha256', $password . $row['salt']);
        } 
        if ($password == $row['password']){
            $ok = true;
        }
		
		if ($ok) { 
			unset($row['salt']); 
			unset($row['password']); 
			$_SESSION['user'] = $row;
			header("Location: dashboard.php"); 
		} else { 
			die("Login failed."); 
			$submitted_username = htmlentities($_POST['user'], ENT_QUOTES, 'UTF-8'); 
		} 
	}
}
?>