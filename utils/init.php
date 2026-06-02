<?php

session_start();

if (!file_exists('storage.txt')) {
	$file = fopen('storage.txt', "w");
	fclose($file);
}

require_once 'functions.php';