<?php
	session_start();
	if (isset($_POST['loginBtn'])) {
		
		include "db.inc.php";
		
		$login = $_POST['login'];
		$pass = $_POST['pass'];

		if (empty($login) || empty($pass)) {
			$_SESSION['error'] = "Proszę wypełnić wszystkie pola";
			header("Location: ../login.php?emptyfields");
			exit();
		}

		else if (!preg_match("/^[a-zA-Z0-9]*$/", $login)) {
			$_SESSION['error'] = "Niepoprawny logn lub hasło";
			header("Location: ../login.php?loginincorrect");
			exit();
		}

		else{
			require "log.inc.php";
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}
	else{
		header("Location: ../login.php");
		exit();
	}
?>
