<?php

function sendResponse(string $status, string|array $message): void
{
    header('Content-Type: application/json');
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}
