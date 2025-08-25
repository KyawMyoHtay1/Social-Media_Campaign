<?php session_start();  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete User</title>
</head>
<body>
	<h1>Delete User</h1>

	<?php

	if(isset($_SESSION['Role']))
	{
		if($_SESSION['Role']=="Admin"){

			include("dbconnection.php");
			//delete

			$rank_id = $_GET['id'];

			$sql = "delete from social_media_rankings where RankID=$rank_id";

			if(mysqli_query($connection, $sql)){
				echo "<script>
						alert('Social Media App is deleted!');
						window.location.href='add_apps.php';
						</script>";
			}
			else{

				echo "<script>
						alert('Deletion error!');
						</script>";

			} 

		}
	}
	else {
		echo "<script>
					alert('Adminstration only!');
				</script>";
			}

	?>

</body>
</html>