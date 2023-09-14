<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add Student Success!</title>
</head>

<body>
    <?php
    include("../connect_db.php");
    include("../utils.php");
    ?>
    <?php

    /* conect to database */

    // Your hCaptcha Secret Key
    $secretKey = 'ES_47641e8e62fd461392936d2b0e4a6ef1';

    // Verify hCaptcha response
    $response = $_POST['h-captcha-response'];
    $url = 'https://hcaptcha.com/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $response,
    ];

    $options = [
        'http' => [
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $jsonResult = json_decode($result);

    if ($jsonResult->success) {
        // hCaptcha verification successful
        // Proceed with user registration logic
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Your registration logic goes here
    
        echo "Registration successful!";
    } else {
        // hCaptcha verification failed
        echo "hCaptcha verification failed. Please try again.";
        header("Location: register_member.php"); // Redirect to the login page
        exit(); // Stop script execution
    
    }
    /* Get form data */
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!isset($username) && !isset($password)) {
        header("Location: register_member.php"); // Redirect to the login page
        exit(); // Stop script execution
    }

    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // hash password by password_hash
    $search_user_query = "INSERT INTO users  (username, password)  VALUES (?,?)";
    $s_stmt = $conn->prepare($search_user_query);
    $s_stmt->bind_param("ss", $username, $hashedPassword);

    if ($s_stmt->execute()) {

        $_SESSION['username'] = $username;

    } else {
        echo "Error: " . $s_stmt->error;
    }

    ?>
    <p>Add student success!</p>
    <p><a href="./index.php">Go back to index page</a></p>
</body>

</html>