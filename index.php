<?php

require 'vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__, '.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);

// Init app instance
$app = require "./core/app.php";

// Get all users from DB, eager load all fields using '*'
$users = User::find($app->db,'*');

// Render view 'views/index.php' and pass users variable there
$app->renderView('index', array(
	'users' => $users
));
