<?php
	session_start();
	require "header.php";
?>
<body>
	<form action="includes/resetPassword.inc.php" method="POST">
		<input type="text" name="email" placeholder="Podaj adres email.."><br>
		<input type="password" name="newPass1" placeholder="Podaj nowe hasło.."><br>
		<input type="password" name="newPass2" placeholder="Powtórz hasło.."><br>
		<button type="submit" name="resetBtn">Resetuj hasło</button>
	</form>
<?php
	if(!empty($_SESSION['error'])){
		echo $_SESSION['error'];
	}
?>
</body>