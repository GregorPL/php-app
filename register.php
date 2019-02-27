<?php
	require "header.php";
	session_start();
?>
<body>
	<form action="includes/register.inc.php" method="POST">
		<input type="text" name="login" placeholder="Podaj login.."><br>
		<input type="text" name="email" placeholder="Podaj adres email.."><br>
		<input type="password" name="pass1" placeholder="Wpisz swoje hasło.."><br>
		<input type="password" name="pass2" placeholder="Powtórz swoje hasło.."><br>
		<button type="submit" name="registerBtn">Wyślij formularz</button>
	</form>
<?php
	if (!empty($_SESSION['error'])) {
		echo '<span style=" font-color: red;">'.$_SESSION['error'].'<span/>';
	}
?>
</body>