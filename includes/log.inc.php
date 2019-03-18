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
			$pwdCheck = password_verify($pass, $row['password']);
			if($pwdCheck == false){
				header("Location: ../login.php?error=wrongpwd");
				exit();
			}
			else if($pwdCheck == true){
				$_SESSION['login'] = $row['login'];
				$_SESSION['id'] = $row['id'];
				$sql_role = "SELECT ur.role_id FROM users_role ur
				JOIN users u ON u.id = ur.users_id
				WHERE u.id =".$_SESSION['id'];
				$row_result = mysqli_fetch_assoc($sql_role);

				if ($row_result['role_id'] == 1) {
					header("Location: ../panel.php?login=succes");
					exit();	
				}
				else{
					/*header("Location: ../sectionOne.php?login=succes");
					exit();*/
					echo mysqli_error($row_result);
				}	
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