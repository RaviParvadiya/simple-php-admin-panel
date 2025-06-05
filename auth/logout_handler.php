<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';

startSession();
destroySession();

header('Location: ../public/login.php');
exit;
