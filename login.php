<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">

	<script src='https://www.google.com/recaptcha/api.js' async defer>
	</script>

</head>
<body class="login">
	<hr>
	<?php
		if(!isset($_COOKIE['login_counter'])){

			?>

<div class="form_container">	
	<div class="title">Login</div>
	<form action="login_process.php" method="post">
		<div class="user_details">
			<div class="input_box">
		<input type="text" name="username" placeholder="Username" required>
		</div>
			<div class="input_box">
		<input type="password" name="password" placeholder="Password" required>
		</div>	
		</div>

		<div class="button">
			<div class="g-recaptcha" data-type="image"  data-sitekey="6Lc-JTAqAAAAAHogDYj3LxhKYQmd5alBCqE9oABZ">
        	</div>
        	<div class="contact_button">
		<input type="submit" name="Login" value="Login">
		<input type="reset" name="Clear" value="Clear">
		</div>
			<hr><br>
	<a href="register.php" class="register-link">Register Here</a>		
	</form>
	</div>

	<?php
		}
		else echo "Blocked!";
	?>

	<script type="text/javascript">
 
        function googleTranslateElementInit() {
 
       new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
 
    }
 
</script>

<script type="text/javascript" 
	src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
	</script>
</body>
</html>