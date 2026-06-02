<?php

$doneTasks = 0;
$notDoneTasks = 0;

if (!isGuest()) {
	foreach (getTasks() as $task) {
		$task["done"] ? $doneTasks++ : $notDoneTasks++;
	}
}

?>

<main>
	<h1>Главная</h1>

	<br>
	
	<?php if (!isGuest()):?>
		<p>Выполненных задач: <?= $doneTasks ?></p>
		<p>Невыполненных задач: <?= $notDoneTasks ?></p>
	<?php else: ?>
		<a href="index.php?page=login">Войдите в систему, чтобы получить доступ к функциям</a>
	<?php endif; ?>
</main>