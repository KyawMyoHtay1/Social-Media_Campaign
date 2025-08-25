<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contact Message</title>
</head>
<body>
	<?php
	include 'dbconnection.php';

	if(isset($_SESSION['Role']))
	{
		if($_SESSION['Role']=="Admin"){

			?>

			<div class="userlist">

			<?php
			include 'header.php';

			include 'search_contact.php';

			include 'admin_menu.php';
			
			echo "<hr>";

			include("dbconnection.php");

			$sql = "select * from contact";

			$result = mysqli_query($connection,$sql);

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

		for($i=0;$i<$num_rows;$i++)
		{

			$record = mysqli_fetch_assoc($result); //one row

			echo "<tr padding=''5px'>";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$record['Firstname']."</td>";
				echo "<td>".$record['Surname']."</td>";
				echo "<td>".$record['Email']."</td>";
				echo "<td>".$record['Message']."</td>";
				echo "<td>".$record['DateSubmitted']."</td>";
				echo "<td>".$record['Remark']."</td>";			
			echo "</tr>";
		}
		echo "</table>";
	}

	else {
			echo "<script>
					alert('Adminstration only!');
				</script>";
	}
}
	include 'footer.php';
	?>

	<script type="text/javascript">
		document.getElementById('you_are_here').innerHTML=
		"<i>You are at <b>Contact Messages page</b></i>";
	</script>

</body>
</html>