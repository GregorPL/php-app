<?php
	$email = $_POST['login'];
	$pass1 = $_POST['newPass1'];
	$pass2 = $_POST['newPass2'];

	if(isset($_POST['resetBtn'])){
		if (empty($pass1) || empty($pass2) || empty($email)) {
			$_SESSION['error'] = "Wypełnij wszystkie pola";
			header("Location: ../resetPassword.php?emptyFields");
		}
		else if(filter_var($email, FILTER_VALIDATE_EMAIL)){
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
		}
	}
	else{
		header("Location: ../resetPassword.php");
	}
?>