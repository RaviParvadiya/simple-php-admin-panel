<?php


require_once '../includes/session.php';

startSession();
destroySession();

header('Location: ../public/authentication-login.php');
exit;
