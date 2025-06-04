<?php

// Define BASE_PATH if not defined (optional safety)
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

// Load Composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Define app-wide constants
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASS', $_ENV['DB_PASS']);
define('BASE_URL', $_ENV['BASE_URL'] . '/public/');

// Define useful folder constants
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('MODELS_PATH', BASE_PATH . '/models');
define('HANDLERS_PATH', BASE_PATH . '/handlers');
define('PUBLIC_PATH', BASE_PATH . '/public');
define('UPLOADS_PATH', BASE_PATH . '/uploads');
define('DATABASE_PATH', BASE_PATH . '/database');
define('AUTH_PATH', BASE_PATH . '/auth');
