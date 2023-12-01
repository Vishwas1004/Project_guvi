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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $Name = mysqli_real_escape_string($conn, $_POST["Name"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $currentStatus = mysqli_real_escape_string($conn, $_POST["currentStatus"]);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST["phoneNumber"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Check if email already exists
    $checkQuery = "SELECT * FROM project_guvi WHERE email = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "User with the same email already exists!";
    } else {
        // Insert new user data
        $insertQuery = "INSERT INTO project_guvi (username, Name, gender, dob, address, email, currentStatus, phoneNumber, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sssssssss", $username, $Name, $gender, $dob, $address, $email, $currentStatus, $phoneNumber, $password);


        if ($insertStmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error during registration: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
}

$conn->close();