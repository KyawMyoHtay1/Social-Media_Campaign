<?php 
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Campaigns Process </title>
		<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body>

	<?php 

		include 'dbconnection.php';

	if(isset($_POST['submit']))
	{
			$name = mysqli_real_escape_string($connection,$_POST['name']);
			$email = mysqli_real_escape_string($connection,$_POST['email']);
			$interset = mysqli_real_escape_string($connection,$_POST['interest']);
			$message= mysqli_real_escape_string($connection,$_POST['message']);

			$sql = "insert into participate(name,email,interest,message)
					values('$name','$email','$interset','$message')";

			if(mysqli_query($connection,$sql)) 
				echo "<script>
						alert('You have participated!');
						window.location.href='campaigns.php';
					</script>";
			
		else echo "<script>
						alert('Failed to participate. Please try again later.');
						window.location.href='campaigns.php';
					</script>";
    }

	?>



</body>
</html>