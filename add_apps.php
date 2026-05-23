<?php
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Social Media Apps Ranking Lists</title>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
</head>
<body class="tips">

    <?php
        include("dbconnection.php");

        // Check if user is logged in and is an administrator
        if (isset($_SESSION['Role']) && $_SESSION['Role'] == 'Admin') {
            include 'header.php'; 
            include 'admin_menu.php';
            include 'search_appadmin.php'; 
    ?>
    
    <hr>
    <section class="social-media-rankings">
        <div class="rankings-header">
            <h2>Social Media Apps Ranking Lists</h2>
            <p>Explore the latest rankings of popular social media apps. Each entry includes a brief description, key features, user ratings, and downloadable reports for in-depth information.</p>
        </div>
        
        <div class="rankings-table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>App Name</th>
                        <th>Description</th>
                        <th>Features</th>
                        <th>Ratings</th>
                        <th>Logo</th>
                        <th>Added Date</th>
                        <th>Download</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

                        $sql = "select * from social_media_rankings
                                where AppName LIKE '%$search%'
                                OR `Rank` LIKE '%$search%'";

                        $result = mysqli_query($connection, $sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                $rank_id = $row['RankID'];

                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["Rank"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["AppName"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Description"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Features"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Ratings"]) . "</td>";
                                echo "<td><img src='photos/logos/" . htmlspecialchars($row["Image"]) . "' alt='" . htmlspecialchars($row["AppName"]) . " Logo' class='ranking-image'></td>";
                                echo "<td>" . htmlspecialchars($row["DateAdded"]) . "</td>";
                                echo "<td><a href='" . htmlspecialchars($row["ReportLink"]) . "' class='download-link' download>Download</a></td>";
                                echo "<td>
                                        <a href='edit_apps.php?id=$rank_id' class='download-link'>Edit</a> || 
                                        <a href='deleteApps.php?id=$rank_id' onclick='return confirmDelete($rank_id);' class='download-link'>Delete</a>
                                      </td>";
                                echo "</tr>";
                            }
                        } 
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <script type="text/javascript">
        function confirmDelete(rankID) {
            return confirm("Are you sure you want to delete?");
        }
    </script>

    <?php
        } else {
            echo "<script>
                    alert('Please login at first! Administrator only!');
                    window.location.href='login.php';
                  </script>";
        }
    ?>

    <?php include 'footer.php'; ?>

    <script type="text/javascript">
        document.getElementById('you_are_here').innerHTML = "<i>You are at <b>Social Media Ranking Apps page</b></i>";
    </script>

</body>
</html>
