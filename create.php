<?php

$app = require "./core/app.php";

$user = new User($app->db);

function returnErrorResponse($message) {
    echo json_encode(['success' => false, 'error' => $message]);
    exit;
}

// Retrieve and sanitize input data
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$phone_number = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING);

// Server-side validation: Server & database security
if (empty($name) || empty($email) || empty($city) || empty($phone_number)) {
    returnErrorResponse('One or more fields are empty.');
}
// Name and city validation
if (strlen($name) < 3 || strlen($city) < 3) {
    returnErrorResponse('Name and city should be at least 3 characters long.');
}
// Validate email 
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    returnErrorResponse('Invalid email address.');
}
// Validate phone number
if (strlen($phone_number) < 3) {
    returnErrorResponse('Invalid phone number.');
}
if (!preg_match('/^[0-9]/', $phone_number)) {
    returnErrorResponse('Invalid phone number format. Only numbers are allowed.');
}

$submittedData = compact('name', 'email', 'city', 'phone_number');

try {
    $user->insert($submittedData);
} catch (Exception $e) {
    returnErrorResponse('Failed to insert user data: ' . $e->getMessage());
}

echo json_encode(['success' => true, 'user' => $submittedData]);

?>