<?php

if (isGuest()) {
	redirect("index.php");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = trim($_POST["title"]);
	$description = trim($_POST["description"]);

	if ($title && $description) {
		$_SESSION["tasks"][] = [
			"id" => uniqid(),
			"title" => $title,
			"description" => $description,
			"done" => false
		];

		redirect("index.php?page=tasks");
	}

	$error = "Поля не могут быть пустыми!";
}

?>

<main>
	<h1>Создание задачи</h1>

	<form method="POST">
		<input
			type="text"
			name="title"
			placeholder="Заголовок"
		/>
		<input
			type="text"
			name="description"
			placeholder="Описание"
		/>
		<button>Создать задачу</button>
	</form>

	<?php if ($error): ?>
		<br>

		<p><?= $error ?></p>
	<?php endif; ?>
</main>