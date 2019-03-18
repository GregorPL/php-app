<?php
	$email = $_POST['email'];
	$pass1 = $_POST['newPass1'];
	$pass2 = $_POST['newPass2'];

	if(isset($_POST['resetBtn'])){
		if (empty($pass1) || empty($pass2) || empty($email)) {
			$_SESSION['error'] = "Wypełnij wszystkie pola";
			header("Location: ../resetPassword.php?emptyFields");
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$_SESSION['error'] = "Niepoprawny adres email";
			header("Location: ../resetPassword.php?invalidEmail");
		}
		else if($pass1 !== $pass2){
			$_SESSION['error'] = "Podane hasła nie są jednakowe";
			header("Location: ../resetPassword.php?passNotMatch");
		}
		else{
			require "db.inc.php";
			$sql = "SELECT email FROM users WHERE email = ?";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../resetPassword.php?sqlStmtError");
			}
			else{
				$hashedPwd = password_hash($pass1, PASSWORD_DEFAULT);
				$sqlUpdate = "UPDATE users SET password = ? WHERE email = ?";
				mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $email);
				mysqli_stmt_execute($stmt);
				header("Location: ../index.php?signup=success");
			}
		}
	}
	else{
		header("Location: ../resetPassword.php");
	}
?>