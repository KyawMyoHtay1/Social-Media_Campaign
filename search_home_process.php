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
	<h1>Safety Tips Lists</h1>

	<div id='mydiv'></div>
	
	<?php

		include("dbconnection.php");

		$search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

		$sql = " select * from safetytip
				 where AppName LIKE '%$search%'
				 or Description LIKE '%$search%'
				 or Safety_tips LIKE '%$search%'
				 or Features LIKE '%$search%'";

		$result = mysqli_query($connection, $sql);

		$num_rows = mysqli_num_rows($result);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='app-result'>";
        echo "<h3>" . $row["AppName"] . " <img src='photos/logos/" . $row["Logo"] . "' alt='" . $row["AppName"] . " Logo' class='app-logo'></h3>";
        echo "<p>" . $row["Description"] . "</p>";
        echo "<ul class='values-list'>";
        echo "<li><strong>Safety Tips:</strong> " . $row["Safety_tips"] . "</li>";
        echo "<li><strong>Features:</strong> " . $row["Features"] . "</li>";
        echo "</ul>";
        echo "</div>";
    }
} else {
    echo "<p>No results found</p>";
}

    include 'footer.php'; 

	?>
    	<script type="text/javascript">
        document.getElementById('you_are_here').innerHTML = "<i>You are at <b>Search Safety Tips page</b></i>";
    </script>


</body>
</html>