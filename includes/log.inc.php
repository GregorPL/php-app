<?php
	require "db.inc.php";
	$sql = "SELECT * FROM users WHERE login = ?";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: login.php?sqlerror");
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "s", $login);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if ($row = mysqli_fetch_assoc($result)) {
			$pwdCheck = password_verify($password, $row['password']);
			if($pwdCheck == false){
				header("Location: ../login.php?error=wrongpwd");
				exit();
			}
			else if($pwdCheck == true){
				session_start();
				$_SESSION['login'] = $row['login'];

				header("Location: ../index.php?login=succes");
				exit();
 			}
 			else{
 				header("Location: ../login.php?error=nouser");
 				exit();
 			}
 		}
 		else{
 			header("Location: ../login.php?error=nouser");
 			exit();
 		}
 	}
?>