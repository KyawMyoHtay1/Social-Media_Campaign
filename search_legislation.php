<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search Anything</title>
	<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body>
	<hr>
	<form action="search_legislation_process.php" method="GET">
		<div class="search">
		<input type="text" name="search" placeholder="Enter any keyword">
		<input type="submit" name="submit" value="Search">
		</div>
	</form>

</body>
</html>