<?php

  include("connect_db.php");
  
    // Check if the submitted username and password are valid
    // Check if a session variable is empty
    if ((isset($_SESSION['username']) && !empty($_SESSION['username'])) && isset($_SESSION['password']) && !empty($_SESSION['password'])) {
        // The 'username' session variable is set and not empty
        $username = $_SESSION['username'];
        echo "Welcome, $username!";
    } else {
        // The 'username' session variable is empty or not set
        echo "Session variable 'username' is empty or not set.";
        $username = $_POST['username'];
        $password = $_POST['password'];
    }

    
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    
    $search_user_query = "SELECT * FROM users WHERE username = (?) and password = (?)";
    $s_stmt = $conn->prepare($search_user_query);
    $s_stmt->bind_param("ss", $username,$password);
    $s_stmt->execute();
    
    $result = $s_stmt->get_result();
    $row = $result->fetch_assoc();
    
?>