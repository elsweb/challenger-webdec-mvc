<?php
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/.env');
date_default_timezone_set('America/Sao_Paulo');

define('APP', $_ENV ?? []);
