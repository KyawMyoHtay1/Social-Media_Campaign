<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Information</title>
</head>
<body>
	<a href="logout.php">Logout</a>
	<?php  include("dbconnection.php");  ?>

	<h1>Registration Information</h1>

	<?php

		if(isset($_POST['submit'])){

			///////////////////////////////

        $captcha = $_POST['g-recaptcha-response'] ?? '';
        if(!$captcha){
 
          echo "<script>
          			alert('Please check the the captcha form.');

          		window.location.href='register.php';
          </script>";
          exit;
 
        }
        if (verify_recaptcha_response($captcha, $_SERVER['REMOTE_ADDR'] ?? '')) {
 
            $fname=	mysqli_real_escape_string($connection,$_POST['fname']);
			$sname= mysqli_real_escape_string($connection,$_POST['sname']);
			$email= mysqli_real_escape_string($connection,$_POST['email']);
			$dob= $_POST['dob'];
			$phone= $_POST['phone'];

			$address = mysqli_real_escape_string($connection,$_POST['address']);
			$country = mysqli_real_escape_string($connection,$_POST['country']);

			$gender = $_POST['gender'];

			$username = mysqli_real_escape_string($connection,$_POST['username']);
			$pw = mysqli_real_escape_string($connection,$_POST['pw']);
			$confirm_pw = mysqli_real_escape_string($connection,$_POST['confirm_pw']);
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
				echo "<script>alert('One User Record is saved!');
					window.location.href='login.php';
					</script>";
			else echo "<script>alert('Saving Error!');
			window.location.href='register.php';
			</script>";
		} //not-existing user
		else {
		echo "<script>alert('Existed Username! Please try again with different username!');
		window.location.href='login.php';
		</script>";
		}

		} //confirm pw
		else {
			echo "<script>alert('Not match your password! Please reenter the password');</script>";
		}

        }
         else {
 
            echo "<script>
            alert('reCaptcha verification failed!');
            window.location.href='register.php';
            </script>";
            exit;
 
        }

	} //submit

	?>

</body>
</html>
