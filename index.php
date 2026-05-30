<?php

require_once 'utils/init.php';

$page = $_GET["page"] ?? "home";

require_once "containers/header.php";
require_once "pages/$page.php";
require_once "containers/footer.php";