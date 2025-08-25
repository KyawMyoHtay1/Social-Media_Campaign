<?php 
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User List </title>
		<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body class="userlist">
	
	<hr>
	<h1>User List</h1>

	<div id='mydiv'></div>
	
	<?php
			include 'header.php';

			include 'admin_menu.php';
			
			echo "<hr>";

		include("dbconnection.php");

		$search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

		$sql = " select * from usertb
				 where Firstname LIKE '%$search%'
				 or Surname LIKE '%$search%'
				 or Email LIKE '%$search%'
				 or Country LIKE '%$search%'";

		$result = mysqli_query($connection, $sql);

		$num_rows = mysqli_num_rows($result);

		echo "<table border='1' padding='5px'>";
		echo "<tr>
				<th>No.</th>
				<th>Profile</th>
				<th>First Name</th>
				<th>Surname</th>
				<th>Email</th>
				<th>PhoneNumber</th>
				<th>Country</th>
				<th>Remark</th>
				<th>Actions</th>
			</tr>";

		if ($num_rows > 0) {
			for ($i = 0; $i < $num_rows; $i++) {
				$user = mysqli_fetch_assoc($result); // One row
				$user_id = $user['Userid'];

				echo "<tr>";
				echo "<td>" . ($i + 1) . "</td>";
				echo "<td><img src='" . htmlspecialchars($user['Profile']) . "' alt='Profile Picture' width='100' height='100'></td>";
				echo "<td>" . htmlspecialchars($user['Firstname']) . "</td>";
				echo "<td>" . htmlspecialchars($user['Surname']) . "</td>";
				echo "<td>" . htmlspecialchars($user['Email']) . "</td>";
				echo "<td>" . htmlspecialchars($user['PhoneNumber']) . "</td>";
				echo "<td>" . htmlspecialchars($user['Country']) . "</td>";
				echo "<td>" . htmlspecialchars($user['Remark']) . "</td>";
				echo "<td>
						<a href='editUser.php?id=$user_id'>Edit</a> ||
						<a href='#' onclick='confirmDelete($user_id)'>Delete</a>
					  </td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='9'>No users found.</td></tr>";
		}
		echo "</table>";
    include 'footer.php'; 

	?>
    	<script type="text/javascript">
        document.getElementById('you_are_here').innerHTML = "<i>You are at <b>Search User Lists page</b></i>";
    </script>
    
	<script>
		function confirmDelete(id) {
			if (confirm('Are you sure you want to delete this user?')) {
				window.location.href = 'deleteUser.php?id=' + id;
			}
		}
	</script>


</body>
</html>