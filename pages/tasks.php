<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	redirect("index.php?page=create-task");
}

$doneTasks = [];
$notDoneTasks = [];

foreach (getTasks() as $task) {
	$task["done"] ? $doneTasks[] = $task : $notDoneTasks[] = $task;
}

usort($notDoneTasks, function($a, $b) {
	return $a["deadline"] <=> $b["deadline"];
});

?>

<main>
	<h1>Задачи</h1>
	<form method="POST">
		<button>Создать задачу</button>
	</form>

	<br>

	<?php if (count($notDoneTasks) > 0):?>
		<ul>
			<b>Невыполненные задачи:</b>
			<?php foreach ($notDoneTasks as $task): ?>
				<li>
					<a href="index.php?page=task&id=<?= $task["id"] ?>"><?= $task["title"] ?></a>
				</li>
			<?php endforeach; ?>
		</ul>

		<br>
	<?php endif; ?>

	<?php if (count($doneTasks) > 0): ?>
		<ul>
			<b>Выполненные задачи:</b>
			<?php foreach ($doneTasks as $task): ?>
				<li>
					<a href="index.php?page=task&id=<?= $task["id"] ?>"><?= $task["title"] ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<?php if (count($doneTasks) + count($notDoneTasks) == 0): ?>
		<p>Нет задач...</p>
	<?php endif; ?>
</main>