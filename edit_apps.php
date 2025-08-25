<?php session_start();  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Apps</title>
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


			$rank_id = $_GET['id'];

			//retrieve role and remark for the user
			$sql = "select * from social_media_rankings where RankID=$rank_id";	

			$result = mysqli_query($connection,$sql);

			$rankings = mysqli_fetch_assoc($result);
			$rank = $rankings['Rank'];
			$appname = $rankings['AppName'];
			$description = $rankings['Description'];
			$features = $rankings['Features'];
			$ratings = $rankings['Ratings'];
			$image = $rankings['Image'];
			$reportlink = $rankings['ReportLink'];

			//ask user to edit using FORM
 
		echo "<form action='editapps_process.php' method='POST'>
				<input type='hidden' name='rank_id' value='$rank_id'>
				<label>Rank:</label>
				<input type='text' name='rank' value='$rank' required><br>
				<label>Appname:</label>
				<input type='text' name='appname' value='$appname' required><br>
				<label>Description:</label>
				<input type='text' name='description' value='$description' required><br>
				<label>Features:</label>
				<input type='text' name='features' value='$features' required><br>
				<label>Ratings:</label>
				<input type='text' name='ratings' value='$ratings' required><br>
				<label>Image:</label>
				<input type='text' name='image' value='$image' required><br>
				<label>Report Link:</label>
				<input type='text' name='reportlink' value='$reportlink' required><br>
				<input type='submit' name='submit' value='Edit'>
				<input type='reset' name='reset' value='Clear'>
			</form>";

		}
	}
	else echo "Administrator only!<br>";

	?>

</body>
</html>