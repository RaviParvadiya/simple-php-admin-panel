<?php

function sendResponse(string $status, string|array $message): array
{
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}
