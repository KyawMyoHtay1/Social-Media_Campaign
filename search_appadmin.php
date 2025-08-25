<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search Apps</title>
	<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body>
	<hr>
	<form action="search_appadmin_process.php" method="GET">
		<div class="search">
		<input type="text" id="search-input" name="search" placeholder="Enter any keyword to search apps">
		<input type="submit" name="submit" value="Search">
		</div>
	</form>

</body>
</html>