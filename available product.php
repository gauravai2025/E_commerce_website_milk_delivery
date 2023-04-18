<?php
require_once "config.php";

// Retrieve data from database
$sql = "SELECT username, quantity,location,category,rate FROM product";
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
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>

	<h2>Available product</h2>

	<table>
		<tr>
			<th>username</th>
			<th>quantity</th>
			<th>location</th>
            <th>category</th>
            <th>rate</th>
		</tr>
		
		<?php
		// Output data from database
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $row["username"] . "</td>";
				echo "<td>" . $row["quantity"] . "</td>";
				echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["rate"] . "</td>";
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
