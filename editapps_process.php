<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
</head>
<body>
    <h1>Edit Rankings Apps</h1>
    <?php
    if (isset($_SESSION['Role'])) {
        if ($_SESSION['Role'] == "Admin") {

            include("dbconnection.php");

            $rank_id = $_POST['rank_id'];
            $rank = $_POST['rank'];
            $appname = $_POST['appname'];
            $description = $_POST['description'];
            $features = $_POST['features'];
            $ratings = $_POST['ratings'];
            $image = $_POST['image'];
            $reportlink = $_POST['reportlink']; // Missing semicolon added here

            // Edit user
            $sql = "update social_media_rankings set Rank='$rank', AppName='$appname', Description='$description', Features='$features', Ratings='$ratings', Image='$image', ReportLink='$reportlink' where RankID=$rank_id";

            if (mysqli_query($connection, $sql)) {
                        echo "<script>
                    alert('Updated Social Apps!');
                    window.location.href='userlist.php';
                </script>";
            } else {
                echo "Updating Failed!<br>";
            }
        }
    } else {
        echo        echo "<script>
                alert('Please login at first! Adminstrator only!');
                window.location.href='login.php';
            </script>";
    }
    ?>
</body>
</html>
