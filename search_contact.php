<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search User</title>
	<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body>
	<hr>
	<div class="search_text">
	<h1>Contact Messages List</h1>
	</div>
	<form action="search_contact_process.php" method="GET">
		<div class="search">
		<input type="text" id="search-input" name="search" placeholder="Enter any keyword to search user">
		<input type="submit" name="submit" value="Search">
		</div>
	</form>

</body>
</html>