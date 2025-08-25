<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contact</title>
	<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body class="contact">

	<?php 

		include 'dbconnection.php';

	if(isset($_POST['submit']))
	{
			$firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
			$surname = mysqli_real_escape_string($connection,$_POST['surname']);
			$email = mysqli_real_escape_string($connection,$_POST['email']);
			$message= mysqli_real_escape_string($connection,$_POST['message']);

			$sql = "insert into contact(Firstname,Surname,Email,Message)
					values('$firstname','$surname','$email','$message')";

			if(mysqli_query($connection,$sql)) 
				echo "<script>
						alert('Your message is sent!');
						window.location.href='home.php';
					</script>";

		else echo "<script>
						alert('Failed to send your message. Please try again later.');
						window.location.href='home.php';
					</script>";
    }

	?>

	<div class="contact_container">	
	<div class="contact_title">Contact Us</div>
	<form action="contact.php" method="post">
		<div class="contact_details">
			<div class="contact_box">
		<input type="text" name="firstname" placeholder="Firstname" required>
		</div>
			<div class="contact_box">
		<input type="text" name="surname" placeholder="Surname" required>
		</div>	
		<div class="contact_box">
		<input type="email" name="email" placeholder="Email" required>
		</div>
		<div class="contact_box">
		<span class="messagedetails">Message</span>
		<textarea name="message" rows="5" required></textarea>
		</div>	
		</div>
		<div class="contact_button">
		<a href="privacy.php" class="privacy-link">Privacy Policy</a>
		<input type="submit" name="submit" value="Send">
		<input type="reset" name="reset" value="Clear">
		</div>
			<hr>
	<a href="home.php" class="home-link">Home Page</a>		
	</form>
	</div>

</body>
</html>