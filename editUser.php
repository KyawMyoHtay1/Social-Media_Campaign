<?php session_start();  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit User</title>
		<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body class="Edit_User">
	<?php

	if(isset($_SESSION['Role']))
	{
		if($_SESSION['Role']=="Admin"){

			include("dbconnection.php");
			//edit


			$user_id = $_GET['id'];

			//retrieve role and remark for the user
			$sql = "select * from usertb where Userid=$user_id";	

			$result = mysqli_query($connection,$sql);

			$user = mysqli_fetch_assoc($result);
			$role = $user['Role'];
			$remark = $user['Remark'];

			//ask user to edit using FORM
 
		echo "<form action='edit_process.php' method='POST'>
				<input type='hidden' name='user_id' value='$user_id'>
				<label>Role:</label>
				<input type='text' name='role' value='$role' required><br>
				<label>Remark:</label>
				<input type='text' name='remark' value='$remark' required><br>
				<input type='submit' name='submit' value='Edit'>
				<input type='reset' name='reset' value='Clear'>
			</form>";

		}
	}
	else echo "<script>
				alert('Please login at first! Adminstrator only!');
				window.location.href='login.php';
			</script>";

	?>

</body>
</html>