<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);
    $secret = $data['secret'];
    error_log("Secret is : " . print_r($secret, true));
    echo json_encode('ok');
} else {
    echo json_encode('error');
}
