<?php

require_once dirname(__DIR__) . '/config/config.php';

function getDBConnection()
{
    try {
        $conn = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conn->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

        $conn->exec("USE `" . DB_NAME . "`");

        return $conn;
    } catch (PDOException $e) {
        // die(json_encode(['error' => 'Database connection failed']));
        throw $e;
    }
}
