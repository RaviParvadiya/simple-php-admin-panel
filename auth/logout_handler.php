<?php


require_once INCLUDES_PATH . '/session.php';

startSession();
destroySession();

header('Location: ../public/login.php');
exit;
