<!DOCTYPE html>
<html lang="ru">
	<head>
		<link rel="stylesheet" href="../style.css" />
		<title>Task Tracker</title>
	</head>
	<body>
		<header>
			<nav>
				<div>
					<a href="index.php">Главная</a>

					<?php if (!isGuest()): ?>
						<a href="index.php?page=tasks">Задачи</a>
					<?php endif; ?>
				</div>
			
				<div>
					<?php if (isset($_SESSION["user"])): ?>
						<a href="index.php?page=logout">Выйти</a>
					<?php else: ?>
						<a href="index.php?page=login">Войти</a>
					<?php endif; ?>
				</div>
			</nav>
		</header>

		<hr>