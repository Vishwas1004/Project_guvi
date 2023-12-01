<?php

// Database connection details
$host = "sql12.freesqldatabase.com";
$database = "sql12666700";
$username = "sql12666700";
$password = "KTPpMA7UdZ";
$port = 3306;

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Read the raw POST data
    $jsonData = file_get_contents("php://input");

    // Decode the JSON data
    $data = json_decode($jsonData);

    // Retrieve email and password
    $email = $data->email;
    $password = $data->password;

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM project_guvi WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if ($password === $user['password']) { // Remove password_verify
            // Login successful
            $response['status'] = 'success';
            $response['message'] = 'Login successful!';
        } else {
            // Login failed - Incorrect password
            $response['status'] = 'error';
            $response['message'] = 'Incorrect email or password.';
        }
    } else {
        // Login failed - User not found
        $response['status'] = 'error';
        $response['message'] = 'Incorrect email or password.';
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
