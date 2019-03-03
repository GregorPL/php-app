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

		else if (!preg_match("/*[a-zA-Z0-9]*/", $login) {
			$_SESSION['error'] = "Niepoprawny login";
			header("Location: ../register.php?loginincorrect");
			exit();
		}

		else if ($pass1 !== $pass2) {
			$_SESSION['error'] = "Podane hasła nie są identyczne :(";
			header("Location: ../register.php?passmis");
			exit();
		}

		else{
			$sql = "SELECT login FROM users WHERE login =?";
			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../register.php?sqlerror");
				exit();
			}

			else{
				mysqli_stmt_bind_param($stmt, "s", $login);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if ($resultCheck > 0) {
					header("Location: ../signup.php?error=sqlerror=&mail=".$email);
					exit();
				}
				else{
					$sql = "INSERT INTO user(login, email, password) VALUES(?,?,?)";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: ../signup.php?error=sqlerror");
						exit();
					}
				}

			}
		}
	}
	else{
		header("Location: ../index.php");
	}
?>
