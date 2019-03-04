<?php
	$sql = "SELECT * FROM users WHERE login = ?";
	$stmt = mysqli_stmt_init($conn); //inicjacja połączenia

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../register.php?sqlerror");
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "s", $login);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$resultCheck = mysqli_stmt_num_rows($stmt);
		if($resultCheck > 0){
			header("Location: ../register.php?userExist");
			exit();
		}
		else{
			$sql = "INSERT INTO users(login, email, password) VALUES(?, ?, ?)";
			$stms = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../register.php?sqlError");
				exit();
			}
			else{
				$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
				mysqli_stmt_bind_param($stmt, "sss", $login, $email, $hashedPwd);
				mysqli_stmt_execute($stmt);
				header("Location: ../register.php?signup=success");
				exit();
			}
		}

	}

?>