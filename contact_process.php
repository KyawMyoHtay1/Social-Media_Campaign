<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Information</title>
</head>
<body>
	<?php  include("dbconnection.php");  ?>

	<h1>Registration Information</h1>

	<?php

		if(isset($_POST['submit'])){

			$fname=	$_POST['fname'];
			$sname= $_POST['sname'];
			$email= $_POST['email'];

			$country = $_POST['country'];
			$message = $_POST['message'];
			

			$gender = $_POST['gender'];

			$username = $_POST['username'];
			$pw = $_POST['pw'];
			$confirm_pw = $_POST['confirm_pw'];
			$sud= $_POST['sud'];

			$profile_name = $_FILES['profile']['name'];
			$temp_name = $_FILES['profile']['tmp_name'];
			//$profile_path = "photos/profile_photos/".$profile_name;
			$profile_path = "photos/profile_photos/".$username."_".$profile_name;

		if($pw==$confirm_pw){
			//existing user

			$sql_search = "select * from usertb where username = '$username'";

			$result = mysqli_query($connection,$sql_search);

			$num_rows = mysqli_num_rows($result);

			if($num_rows<1){
				//saving information

				copy($temp_name,$profile_path);

				$hashed_pw = password_hash($pw, PASSWORD_DEFAULT);

				$sql = "insert into usertb(Firstname, Surname, Gender, PhoneNumber, DOB, Email, Address, Username, Password, Country, Profile, SignupDate, Role, Remark) 
					values('$fname','$sname','$gender','$phone','$dob','$email','$address','$username','$hashed_pw','$country','$profile_path','$sud','user','no remark')";

			if (mysqli_query($connection,$sql)) 
				echo "One User Record is saved!<br>";
			else echo "Saving Error!<br>";
		} //not-existing user
		else {
		echo "Existed Username! Please try again with different username!<br>";
		}

		} //confirm pw
		else {
			echo "Not match your password! Please reenter the password<br>";
		}

	} //submit

	?>
	<hr>
	<a href="register.php">Go Back to Register Form</a>
</body>
</html>