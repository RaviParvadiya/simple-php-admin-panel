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
