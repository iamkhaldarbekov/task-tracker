<?php

function redirect(string $path): void {
	header("Location: $path");
	exit();
}

function isGuest(): bool {
	return !isset($_SESSION["user"]);
}

function tasksFactory() {
	if (isset($_SESSION["tasks"])) return;
	
	$tasks = [
		[
			"id" => uniqid(),
			"title" => "Покушать",
			"description" => "Надо конкретно покушать. В вариантах у меня сосиски жаренные/варенные, либо колбаса.",
			"done" => false
		],
		[
			"id" => uniqid(),
			"title" => "Попить",
			"description" => "Выпить можно воду, она в 10-ти литровой баклашке. Кола кончилась, но в любом случае не хотел её пить, вредно.",
			"done" => false
		]
	];

	$_SESSION["tasks"] = $tasks;
}