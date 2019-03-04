<?php
	session_start();
	if (isset($_POST['registerBtn'])) {
		
		include "db.inc.php";
		
		$login = $_POST['login'];
		$email = $_POST['email'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];

		if (empty($login) || empty($email) || empty($pass1) || empty($pass2)) {
			$_SESSION['error'] = "Proszę wypełnić wszystkie pola";
			header("Location: ../register.php?emptyfields");
			exit();
		}

		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['error'] = "Proszę podać poprawny adres email";
			header("Location: ../register.php?emailincorrect");
			exit();
		}

		else if (!preg_match("/^[a-zA-Z0-9]*$/", $login)) {
			$_SESSION['error'] = "asd";
			header("Location: ../register.php?loginincorrect");
			exit();
		}

		else if ($pass1 !== $pass2) {
			$_SESSION['error'] = "Podane hasła nie są identyczne :(";
			header("Location: ../register.php?passmis");
			exit();
		}

		else{
			require "reg.inc.php";
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}
	else{
		header("Location: ../index.php");
		exit();
	}
?>
