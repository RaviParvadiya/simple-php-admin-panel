<?php

header('Content-Type: application/json');

require_once dirname(__DIR__) . '/config/config.php';
require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/AdminModel.php';

$conn = getDBConnection();

$username = trim($_GET['username'] ?? '');
$email = trim($_GET['email'] ?? '');

try {
    if ($username !== '') {
        $user = getUserByName($conn, $username);
        if ($user !== null) {
            sendResponse('exists', 'User already exists');
        }
    }
    if ($email !== '') {
        $email = getUserByEmail($conn, $email);
        if ($email !== null) {
            sendResponse('exists', 'Email already registered');
        }
    }
} catch (PDOException $e) {
    sendResponse('error', 'Server error occurred');
}
