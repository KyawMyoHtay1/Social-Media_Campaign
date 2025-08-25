<?php 
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User List </title>
		<link rel="stylesheet" type="text/css" 
		  href="css/style.css?<?php echo time(); ?>">
</head>
<body>


	<?php

	if(isset($_SESSION['Role']))
	{
		if($_SESSION['Role']=="Admin"){
			
			?>

			<div class="userlist">

			<?php
			include 'header.php';

			include 'search_user.php';

			include 'admin_menu.php';
			
			echo "<hr>";

		include("dbconnection.php");

		$sql = "select * from usertb"; //all user // where role='user';

		$result = mysqli_query($connection,$sql);

		$num_rows = mysqli_num_rows($result);

		echo "<table border='1' padding='5px'>";
		echo "<tr>
				<th>No.</th>
				<th>Profile</th>
				<th>First Name</th>
				<th>Surname</th>
				<th>Email</th>
				<th>PhoneNumber</th>
				<th>Country</th>
				<th>Remark</th>
				<th>Actions</th>
			</tr>";
		for($i=0;$i<$num_rows;$i++)
		{

			$user = mysqli_fetch_assoc($result); //one row
			$user_id = $user['Userid'];

			echo "<tr padding=''5px'>";
				echo "<td>".($i+1)."</td>";
				echo "<td>
					<img src='".$user['Profile']."' alt='Profile Picture' 
						width='100px' height='100px'>
					</td>";
				echo "<td>".$user['Firstname']."</td>";
				echo "<td>".$user['Surname']."</td>";
				echo "<td>".$user['Email']."</td>";
				echo "<td>".$user['PhoneNumber']."</td>";
				echo "<td>".$user['Country']."</td>";
				echo "<td>".$user['Remark']."</td>";
				echo "<td><a href='editUser.php?id=$user_id'>Edit</a> ||
					   <a href='#' onclick='confirmDelete(".$user_id.")'>Delete</a>
				      </td>";
			//<a href='deleteUser.php?id=$user_id'>Delete</a>
			
			echo "</tr>";
		}//end for
		echo "</table>";
		}//admin role
		else{
			//echo "Adminstrator only!<br>";
			echo "<script>
					alert('Adminstration only!');
					window.location.href='login.php';
				</script>";
		}
	}//isset
	else{
		//echo "Please login at first! Adminstrator only!<br>";
		echo "<script>
				alert('Please login at first! Adminstrator only!');
				window.location.href='login.php';
			</script>";
	}

	?>



	<script type="text/javascript">
		
		function confirmDelete(user_id){

			if(confirm("Are you sure you want to delete?"))
			{
				window.location.href="deleteUser.php?id="+user_id;
			}else{
				document.getElementById('mydiv').innerHTML="<b><i>Cancel to delete user!</i></b>"
			}

		}
	</script>

    <?php include 'footer.php'; ?>

    <script type="text/javascript">
        document.getElementById('you_are_here').innerHTML = "<i>You are at <b>Userlist page</b></i>";
    </script>
	</div>
</body>
</html>