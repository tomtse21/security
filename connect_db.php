<?php

// Create connection
$conn = mysqli_connect("localhost", "root", "", "covid19_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>