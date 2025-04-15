<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: {$conn->connect_error}");
}

// Check if the database exists
if (!$conn->select_db($dbname)) {
    die("Database selection failed: {$conn->error}");
}
