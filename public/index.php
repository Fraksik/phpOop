<?php
$config = include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/../vendor/autoload.php";

\app\base\App::call()->run($config);
