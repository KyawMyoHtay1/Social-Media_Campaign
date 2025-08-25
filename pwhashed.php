<?php

	$admin_pw = "12345";

	$hashed = password_hash($admin_pw, PASSWORD_DEFAULT);

	echo $hashed;

	//$2y$10$Acx7TyLR4gc2svr6zLcIjuvRQB2FOkwcDA0YPlt.IOOh7dTKWHleC

?>