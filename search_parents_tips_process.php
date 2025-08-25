<?php 
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Safety Tips Lists </title>
		<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body class="userlist">
	<?php include 'header.php'; ?>
	
	<?php include 'menu.php'; ?>

	<hr>
	<h1>How Parents Can Help</h1>

	<div id='mydiv'></div>
	
	<?php

		include("dbconnection.php");

		$search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

		$sql = " select * from parentstip
				 where Title LIKE '%$search%'
				 or Description LIKE '%$search%'";

		$result = mysqli_query($connection, $sql);

		$num_rows = mysqli_num_rows($result);

if ($result->num_rows > 0) {
    echo "<div class='search-results'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='tip-result'>";
        echo "<h3>" . htmlspecialchars($row["Title"]) . "</h3>";
        echo "<img src='photos/guidance/" . htmlspecialchars($row["Image"]) . "' alt='" . htmlspecialchars($row["Title"]) . "' class='result-image'>";
        echo "<p>" . htmlspecialchars($row["Description"]) . "</p>";
        echo "<ul class='tips-list'>";
        echo "<li>" . htmlspecialchars($row["Tips"]) . "</li>";
        echo "</ul>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>No results found for your search.</p>";
}

    include 'footer.php'; 

	?>
    	<script type="text/javascript">
        document.getElementById('you_are_here').innerHTML = "<i>You are at <b>Search Parents Tips page</b></i>";
    </script>
</body>
</html>