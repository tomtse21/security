<?php

include("connect_db.php");
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);



$search_user_query = "SELECT * FROM users WHERE username = (?)";
$s_stmt = $conn->prepare($search_user_query);
$s_stmt->bind_param("s", $username);
$s_stmt->execute();

$result = $s_stmt->get_result();

$row = $result->fetch_assoc();
if (mysqli_num_rows($result) == 1) {

    $_SESSION['username'] = $username;
    session_regenerate_id();
    // Regenerate the session ID to prevent session fixation
    echo $row['password'];

    if (password_verify($password, $row['password'])) {

        header('Location: index.php');
    } else {
        echo "try again";
    }

    exit;

} else {
    echo "Wrong username or password ";
}


?>