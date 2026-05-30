<?php

if (isGuest()) {
	redirect("index.php");
}

$foundTask = null;

if (isset($_GET["id"])) {
	$id = $_GET["id"];

	foreach ($_SESSION["tasks"] as $task) {
		if ($task["id"] == $id) {
			$foundTask = $task;
			break;
		}
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["status"])) {
		foreach ($_SESSION["tasks"] as $key => $value) {
			if ($value["id"] == $foundTask["id"]) {
				$_SESSION["tasks"][$key]["done"] = !$_SESSION["tasks"][$key]["done"];

				redirect("index.php?page=task&id=" . $foundTask["id"]);
			}
		}
	}

	if (isset($_POST["edit"])) {
		redirect("index.php?page=edit-task&id=" . $foundTask["id"]);
	}

	if (isset($_POST["delete"])) {
		foreach ($_SESSION["tasks"] as $key => $value) {
			if ($value["id"] == $foundTask["id"]) {
				unset($_SESSION["tasks"][$key]);
				$_SESSION["tasks"] = array_values($_SESSION["tasks"]);

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