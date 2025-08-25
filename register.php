<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
		  
		  <script src='https://www.google.com/recaptcha/api.js' async defer>
</script>

</head>
<body class="register">
	<?php //include 'header.php'; ?>
	
<div class="form_container">	
	<div class="title">Registration</div>
	<form action="register_process.php" method="post" enctype="multipart/form-data">
		<div class="user_details">
			<div class="input_box">
				<span class="details">First Name</span>
				<input type="text" name="fname" placeholder="Enter your first name" required>
				</div>
				<div class="input_box">
				<span class="details">Surname</span>
        <input type="text" name="sname" placeholder="Enter your surname" required>
        </div>
        <div class="input_box">
				<span class="details">Email</span>
        <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="input_box">
				<span class="details">Phone Number</span>
        <input type="number" name="phone" placeholder="Enter your phonenumber" required>
        </div>
        <div class="input_box">
				<span class="details">Date Of Birth</span>
        <input type="date" name="dob" placeholder="Enter your DOB" required>
        </div>
        <div class="input_box">
				<span class="details">Address</span>
		<textarea name="address"></textarea>
		</div>
        <div class="input_box">
				<span class="details">Country</span>
		<?php
			$country = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
			//sort($country);

			//echo count($country);
		echo  "<select name='country'>";
		echo "<option value='0'>--- Choose your country --- </option>";
				for($i=0;$i<count($country);$i++){
					echo "<option value='".$country[$i]."'>$country[$i]</option>";
				}

		 echo  "</select>";
		?>
		</div>
		        <div class="input_box">
				<span class="details">Username</span>
		<input type="text" name="username" placeholder="Enter your username" required>
		</div>
		        <div class="input_box">
				<span class="details">Password</span>
		<input type="password" name="pw" placeholder="Enter your password" required>
		</div>
		        <div class="input_box">
				<span class="details">Confirm Password</span>
		<input type="password" name="confirm_pw" placeholder="Enter your confirm password" required>
		</div>
		        <div class="input_box">
				<span class="details">Profile Photo</span>
		<input type="file" name="profile" required>
		</div>
				<div class="input_box">
				<span class="details">Sign Up Date</span>
		<input type="date" name="sud" placeholder="Sign Up Date" required>
		</div>
        </div>
        <div class="gender-details">
        <input type="radio" name="gender" id="dot-1" value="Male">
		<input type="radio" name="gender" id="dot-2" value="Female">
		<input type="radio" name="gender" id="dot-3" value="NotSay">
				<span class="gender-title">Gender</span>
				<div class="category">
					<label for="dot-1">
						<span class="dot one"></span>
						<span class="gender">Male</span>
					</label>
					<label for="dot-2">
						<span class="dot two"></span>
						<span class="gender">Female</span>
					</label>
					<label for="dot-3">
						<span class="dot three"></span>
						<span class="gender">Prefer not to say</span>
					</label>
			</div>
		</div>
        <div class="button">
        	<div class="g-recaptcha" data-type="image"  data-sitekey="6Lc-JTAqAAAAAHogDYj3LxhKYQmd5alBCqE9oABZ">
        	</div>
        	<div class="contact_button">
        	<input type="submit" name="submit" value="Register">
        	<input type="reset" name="reset" value="Clear">
        </div>	
        <hr><br>        	
		<a href="login.php" class="register-link">Login</a>	
		</form>
</div>

</body>
</html>