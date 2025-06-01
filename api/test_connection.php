<?php

header('Contenty-Type: application/json');

require_once '../database/connection.php';

echo json_encode([
    'status' => 'success',
    'message' => 'Database connected successfully'
]);
