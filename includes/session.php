<?php

function startSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function setSession($key, $value)
{
    $_SESSION[$key] = $value;
}

function getSession($key)
{
    return $_SESSION[$key] ?? null;
}

function destroySession()
{
    session_unset();
    session_destroy();
}

function checkUserSession()
{
    startSession();

    $timeout_duration = 900; // 900 seconds = 15 minutes

    if (!isset($_SESSION['admin_id'])) {
        destroySession();
        header("Location: authentication-login.php");
        exit;
    }

    // Check if this is NOT the first request (last_activity exists) 
    // and if the inactivity duration has exceeded the timeout
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
        destroySession();
        header("Location: authentication-login.php?timeout=1");
        exit;
    }

    $_SESSION['last_activity'] = time();
}
