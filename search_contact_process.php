<?php 
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contact Messages List </title>
		<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body class="userlist">
	
	<hr>
	<h1>Contact Messages List</h1>

	<div id='mydiv'></div>
	
	<?php

		include("dbconnection.php");

		$search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

		$sql = " select * from contact
				 where Firstname LIKE '%$search%'
				 or Surname LIKE '%$search%'
				 or Email LIKE '%$search%'";

		$result = mysqli_query($connection, $sql);

		$num_rows = mysqli_num_rows($result);

		echo "<table border='1' padding='5px'>";
		echo "<tr>
				<th>No.</th>
				<th>First Name</th>
				<th>Surname</th>
				<th>Email</th>
				<th>Message</th>
				<th>DateSubmitted</th>
				<th>Remark</th>
			</tr>";

		if ($num_rows > 0) {
			for ($i = 0; $i < $num_rows; $i++) {
				$record = mysqli_fetch_assoc($result); // One row

				echo "<tr>";
				echo "<td>" . ($i + 1) . "</td>";
				echo "<td>" . htmlspecialchars($record['Firstname']) . "</td>";
				echo "<td>" . htmlspecialchars($record['Surname']) . "</td>";
				echo "<td>" . htmlspecialchars($record['Email']) . "</td>";
				echo "<td>" . htmlspecialchars($record['Message']) . "</td>";
				echo "<td>" . htmlspecialchars($record['DateSubmitted']) . "</td>";
				echo "<td>" . htmlspecialchars($record['Remark']) . "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='9'>No users found.</td></tr>";
		}
		echo "</table>";
	?>

	<script>
		function confirmDelete(id) {
			if (confirm('Are you sure you want to delete this user?')) {
				window.location.href = 'deleteUser.php?id=' + id;
			}
		}
	</script>


</body>
</html>