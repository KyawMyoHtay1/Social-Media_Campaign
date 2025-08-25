<?php 
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campaigns Lists</title>
</head>
<body>
    <?php
    include 'dbconnection.php';

    if (isset($_SESSION['Role']) && $_SESSION['Role'] == "Admin") {

			?>

			<div class="userlist">

			<?php

        include 'header.php';
        echo "<h1>Campaigns Lists</h1>";
        include 'admin_menu.php';
        echo "<hr>";

        $sql = "select * from participate";
        $result = mysqli_query($connection, $sql);

        if ($result) {
            $num_rows = mysqli_num_rows($result);

            echo "<table border='1' cellpadding='5px'>";
            echo "<tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Interest</th>
                    <th>Message</th>
                    <th>DateAdded</th>
                    <th>Remark</th>
                  </tr>";

            for ($i = 0; $i < $num_rows; $i++) {
                $record = mysqli_fetch_assoc($result); //one row

                echo "<tr>";
                echo "<td>" . ($i + 1) . "</td>";
                echo "<td>" . htmlspecialchars($record['name']) . "</td>";
                echo "<td>" . htmlspecialchars($record['email']) . "</td>";
                echo "<td>" . htmlspecialchars($record['interest']) . "</td>";
                echo "<td>" . htmlspecialchars($record['message']) . "</td>";
                echo "<td>" . htmlspecialchars($record['DateAdded']) . "</td>";
                echo "<td>" . htmlspecialchars($record['Remark']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Error retrieving data.</p>";
        }
    } else {
        echo "<script>
                alert('Please login at first! Administrator only!');
                window.location.href = 'login.php';
              </script>";
    }
    ?>

    <?php include 'footer.php'; ?>

    <script type="text/javascript">
        document.getElementById('you_are_here').innerHTML = "<i>You are at <b>Campaigns Lists page</b></i>";
    </script>

</body>
</html>
