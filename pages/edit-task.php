<?php

if (isGuest()) {
	redirect("index.php");
}

$foundTask = null;
$error = "";

if (isset($_GET["id"])) {
	$id = $_GET["id"];

	foreach (getTasks() as $task) {
		if ($task["id"] == $id) {
			$foundTask = $task;
			break;
		}
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = trim($_POST["title"]);
	$description = trim($_POST["description"]);

	if ($title && $description) {
		$tasks = getTasks();

		foreach ($tasks as &$task) {
			if ($task["id"] == $foundTask["id"]) {
				$task["title"] = $title;
				$task["description"] = $description;
				$task["deadline"] = $_POST["deadline"];

				unset($task);

				file_put_contents('storage.txt', json_encode($tasks));
				redirect("index.php?page=task&id=" . $foundTask["id"]);
			}
		}
	}

	$error = "Поля не могут быть пустыми!";
}

?>

<main>
	<h1>Редактирование задачи</h1>

	<form method="POST">
		<input
			type="text"
			name="title"
			placeholder="Заголовок"
			value="<?= $foundTask["title"] ?>"
			required
		/>
		<input
			type="text"
			name="description"
			placeholder="Описание"
			value="<?= $foundTask["description"] ?>"
			required
		/>
		<input
			type="date"
			name="deadline"
			value="<?= $foundTask["deadline"] ?>"
			required
		/>
		<button>Сохранить</button>
	</form>

	<?php if ($error): ?>
		<br>

		<p><?= $error ?></p>
	<?php endif; ?>
</main>