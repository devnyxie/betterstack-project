<?php

require 'vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Init app instance
$app = require __DIR__ . "/core/app.php";

// Get all users from DB, eager load all fields using '*'
$users = User::find($app->db,'*');

// Render view 'views/index.php' and pass users variable there
$app->renderView('index', array(
	'users' => $users
));
