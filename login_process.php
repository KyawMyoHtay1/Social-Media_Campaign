<?php
session_start();
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body>
	<?php 
		///////////////////////////////////
		//login counter

		if(isset($_SESSION['login_counter']))
		{
			$counter = $_SESSION['login_counter'];
		}
		else
		{
			$counter=0;
		}

		//////////////////////////////////

		include("dbconnection.php");  


        $captcha = $_POST['g-recaptcha-response'] ?? '';
        if(!$captcha){
          
          echo "<script>
          			alert('Please check the the captcha form.');

          		window.location.href='login.php';
          </script>";
          exit;
 
        }
        if (verify_recaptcha_response($captcha, $_SERVER['REMOTE_ADDR'] ?? '')) {
 
        	$username=	$_POST['username'];
		$password= $_POST['password'];

		$sql = "select * from usertb where Username='$username'";

		$result = mysqli_query($connection,$sql);

		$num_rows = mysqli_num_rows($result);


		if($num_rows==1){

			$record = mysqli_fetch_assoc($result);
			$hashed_pw = $record['Password'];

			if(password_verify($password, $hashed_pw)){
				echo "Welcome $username<br>";
				if($username=="admin" && $record['Role']=="Admin"){

					$_SESSION['Role']="Admin";

					echo "<script>
							window.location.href='userlist.php'
						</script>";

					//user list
					//include("userlist.php");	
					//echo "<a href='userlist.php'>Go to User List</a>";

				}//admin only
				else{

						echo "<script>
							window.location.href='home.php'
						</script>";	

				}//user only

			}//correct password
			else {	
				//echo "Invalid Password! Please try again!";

				$counter++;
				$_SESSION['login_counter']=$counter;
				if($counter==3){				
					echo "<script>
					  window.location.href='loginTimer.php';
					  </script>";

					  setcookie("login_counter","c",time()+10*60);

				}
				else{
					echo "<script>
					  alert('Invalid Password! Please try again!');
					  window.location.href='login.php';
					  </script>";
				}

			}//invalid password
		}
		else{
			//echo "Invalid Username! Please try again!";
			echo "<script>
						alert('Invalid Username! Please try again!');
						window.location.href='login.php';
						</script>";
		}
 
        }
         else {
 
                echo "<script>
                		alert('reCaptcha verification failed!');
                		window.location.href='login.php';
                		</script>";
                exit;
 
        }

	?>
	
	<hr>
	<a href="login.php">Login</a>

</body>
</html>
