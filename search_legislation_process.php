<?php 
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Legislation and Guidance </title>
		<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body class="userlist">
	<?php include 'header.php'; ?>
	
	<?php include 'menu.php'; ?>

	<hr>
	<h1>Legislation and Guidance</h1>

	<div id='mydiv'></div>
	
	<?php

		include("dbconnection.php");

		$search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

		$sql = " select * from legislation
				 where Title LIKE '%$search%'
				 or Description LIKE '%$search%'";

		$result = mysqli_query($connection, $sql);

		$num_rows = mysqli_num_rows($result);

		if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='guidance-card'>";
                if (!empty($row["Image"])) {
                    echo "<img src='photos/legislation/" . $row["Image"] . "' alt='" . $row["Title"] . "' class='guidance-image'>";
                }
                echo "<h3>" . $row["Title"] . "</h3>";
                echo "<ul class='values-list'>";
        echo "<li><strong>Discription :</strong> " . $row["Description"] . "</li>";
        echo "<li><strong>Guidance :</strong> " . $row["Guidance"] . "</li>";
                echo "</div>";
        }
        } else {
            echo "<p>No information available at the moment.</p>";
        }


	    include 'footer.php'; 

	?>
    	<script type="text/javascript">
        document.getElementById('you_are_here').innerHTML = "<i>You are at <b>Search Guidance page</b></i>";
    </script>