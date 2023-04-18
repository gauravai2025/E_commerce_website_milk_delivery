<?php
require_once "config.php";

// Retrieve data from database
$sql = "SELECT username, agency,charge,time1,location FROM transport";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>available product</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
			border: 1px solid black;


		}

		th {
			background-color:white;
		}
        
	</style>
</head>
<body>

	<h2>Available transport</h2>

	<table>
		<tr>
			<th>username</th>
			<th>agency</th>
			<th>charge(per km)</th>
            <th>time(per km) in minutes</th>
            <th>location</th>
		</tr>
		
		<?php
		// Output data from database
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $row["username"] . "</td>";
				echo "<td>" . $row["agency"] . "</td>";
				echo "<td>" . $row["charge"] . "</td>";
                echo "<td>" . $row["time1"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='5'>No results found</td></tr>";
		}
		$conn->close();
		?>
		
	</table>

</body>
</html>
