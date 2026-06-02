<?php

function redirect(string $path): void {
	header("Location: $path");
	exit();
}

function isGuest(): bool {
	return !isset($_SESSION["user"]);
}

function getTasks(): array {
	$tasks = json_decode(file_get_contents('storage.txt'), true);

	if (!is_array($tasks)) return [];

	return $tasks;
}