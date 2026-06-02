<?php

if (isGuest()) {
	redirect("index.php");
}

$foundTask = null;

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
	if (isset($_POST["status"])) {
		$tasks = getTasks();

		foreach ($tasks as &$task) {
			if ($task["id"] == $foundTask["id"]) {
				$task["done"] = !$task["done"];

				unset($task);

				file_put_contents('storage.txt', json_encode($tasks));
				redirect("index.php?page=task&id=" . $foundTask["id"]);
			}
		}
	}

	if (isset($_POST["edit"])) {
		redirect("index.php?page=edit-task&id=" . $foundTask["id"]);
	}

	if (isset($_POST["delete"])) {
		$tasks = getTasks();

		foreach ($tasks as $key => $value) {
			if ($value["id"] == $foundTask["id"]) {
				unset($tasks[$key]);
				$tasks = array_values($tasks);

				file_put_contents('storage.txt', json_encode($tasks));
				redirect("index.php?page=tasks");
			}
		}
	}
}

if (!$foundTask) {
	redirect("index.php");
}

?>

<main>
	<h1><?= $foundTask["title"] ?></h1>
	<form method="POST">
		<button name="status">Сменить статус</button>
		<button name="edit">Редактировать</button>
		<button name="delete">Удалить</button>
	</form>

	<br>
	
	<div>
		<b>Статус:</b>
		<span><?= $foundTask["done"] ? "Выполнена" : "Не выполнена" ?></span>
	</div>

	<br>

	<div>
		<b>Описание:</b>
		<p><?= $foundTask["description"] ?></p>
	</div>
</main>