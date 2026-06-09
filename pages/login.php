<?php

if (!isGuest()) {
	redirect("index.php");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$login = $_POST["login"];
	$pass = $_POST["pass"];
	
	if ($login == "admin" && $pass == "123") {
		$_SESSION["user"] = [
			"login" => $login
		];

		redirect("index.php");
	}

	$error = "Введены неверные данные!";
}

?>

<main>
	<h1>Вход</h1>
	<form method="POST">
		<input
			type="text"
			name="login"
			placeholder="Логин"
			required
		/>
		<input
			type="password"
			name="pass"
			placeholder="Пароль"
			required
		/>
		<button>Войти</button>
	</form>

	<?php if ($error): ?>
		<br>

		<p><?= $error ?></p>
	<?php endif; ?>
</main>