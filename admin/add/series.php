<html>
	<body>
		<form action="addseries.php" method="post">
			Date: <input type="text" name="date"> YYYY-MM-DD<br>
			Best Of: <input type="text" name="bestof"><br>
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
			
			Event: <select name="event">
				<?php
					$events = Tools::searchDb("SELECT * FROM events");
					if ($events->num_rows > 0) {
						// output data of each row
						while($evRow = $events->fetch_assoc()) {
							echo '<option value="'.$evRow['id'].'">'.$evRow['name'].'</option>';
						}
					}
				?>
			</select><a href="event.php"> add event</a><br>
			Team A: <input type="text" name="teamA"><br>
			Team B: <input type="text" name="teamB"><br>
			Map 1: <input type="text" name="map1"><br>
			Map 2: <input type="text" name="map2"><br>
			Map 3: <input type="text" name="map3"><br>
			Map 4: <input type="text" name="map4"><br>
			Map 5: <input type="text" name="map5"><br>
			Map 6: <input type="text" name="map6"><br>
			Map 7: <input type="text" name="map7"><br>
			Map 8: <input type="text" name="map8"><br>
			Map 9: <input type="text" name="map9"><br>
			Map 10: <input type="text" name="map10"><br>
			Map 11: <input type="text" name="map11"><br>
			<input type="submit">
		</form>
	</body>
</html>