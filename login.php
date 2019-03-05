<?php
	session_start();
	require "header.php";
?>
<body>
	<form action="includes/login.inc.php" method="POST">
		<input type="text" name="login" placeholder="Login.."><br>
		<input type="password" name="pass" placeholder="Your password.."><br>
		<button type="submit" name="loginBtn">Login</button>
	</form>
<?php
	if(!empty($_SESSION['error'])){
		echo $_SESSION['error'];
	}
?>
</body>