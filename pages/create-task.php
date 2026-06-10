<?php

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = trim($_POST["title"]);
	$description = trim($_POST["description"]);

	if ($title && $description) {
		$task = [
			"id" => uniqid(),
			"title" => $title,
			"description" => $description,
			"deadline" => $_POST["deadline"],
			"done" => false
		];

		$tasks = getTasks();
		$tasks[] = $task;
		file_put_contents('storage.txt', json_encode($tasks));

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
			required
		/>
		<input
			type="text"
			name="description"
			placeholder="Описание"
			required
		/>
		<input
			type="date"
			name="deadline"
			required
		/>
		<button>Создать задачу</button>
	</form>

	<?php if ($error): ?>
		<br>

		<p><?= $error ?></p>
	<?php endif; ?>
</main>