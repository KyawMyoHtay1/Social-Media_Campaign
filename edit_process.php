	<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit User</title>
		<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body>
	<h1>Edit User</h1>
	<?php

	if(isset($_SESSION['Role']))
	{
		if($_SESSION['Role']=="Admin"){

			include("dbconnection.php");

			$user_id = $_POST['user_id'];
			$role = $_POST['role'];
			$remark = $_POST['remark'];

			//edit user
			$sql = "update usertb set Role='$role',Remark='$remark' where Userid=$user_id";

			if(mysqli_query($connection,$sql)){
			echo "<script>
					alert('Updated User!');
					window.location.href='userlist.php';
				</script>";
			}
			else echo "Updating Fail!<br>";
		}
	}
	else 		echo "<script>
				alert('Please login at first! Adminstrator only!');
				window.location.href='login.php';
			</script>";
	?>

</body>
</html>