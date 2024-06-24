<?php

$app = require "./core/app.php";

$user = new User($app->db);

// Function to return JSON error responses
function returnErrorResponse($message) {
    echo json_encode(array(
        'success' => false,
        'error' => $message
    ));
    exit;
}

// Retrieve input data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$city = isset($_POST['city']) ? trim($_POST['city']) : '';
$phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';

// --- Server Side Validation: Server & Database Security ---
// Sanitize input data
$sanitized_name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
$sanitized_city = filter_var($city, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (preg_match("/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/", $phone_number)) {
	// phone number matches expected format
	$sanitized_phone_number = $phone_number;
} else {
	returnErrorResponse('Invalid phone number format.');
}

// Server-side validation: check if any required field is empty
if (empty($sanitized_name) || empty($sanitized_email) || empty($sanitized_city) || empty($sanitized_phone_number)) {
    returnErrorResponse('One or more fields are empty.');
}

// Validate input fields
// 1. Name and city should be at least 3 characters long
if (strlen($sanitized_name) < 3 || strlen($sanitized_city) < 3) {
    returnErrorResponse('Name and city should be at least 3 characters long.');
}

// 2. Email should be valid
if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
    returnErrorResponse('Invalid email address.');
}

// 3. Phone number should be valid (min 3 chars)
if (strlen($sanitized_phone_number) < 3) {
    returnErrorResponse('Invalid phone number.');
}

$submittedData = array(
    'name' => $name,
    'email' => $email,
    'city' => $city,
    'phone_number' => $phone_number
);

try {
    $user->insert($submittedData);
} catch (Exception $e) {
    returnErrorResponse('Failed to insert user data: ' . $e->getMessage());
}

// Return JSON response with success status and user data
echo json_encode(array(
    'success' => true,
    'user' => $submittedData
));

?>
