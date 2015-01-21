<html>
	<body>
		<form action="addevent.php" method="post">
			Host: <select name="host">
				<?php
					include '../../include/Tools.php'; 
					$hosts = Tools::searchDb("SELECT * FROM hosts");
					if ($hosts->num_rows > 0) {
						// output data of each row
						while($hRow = $hosts->fetch_assoc()) {
							echo '<option value="'.$hRow['id'].'">'.$hRow['name'].'</option>';
						}
					}
				?>
			</select><a href="host.php"> add host</a><br>
			Name: <input type="text" name="name"><br>
			<input type="submit">
		</form>
	</body>
</html>