<?php
    include("../connect_db.php");
    include("../utils.php");


    captchaValidation();
    
    /* Get form data */
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!isNotEmpty($username) && !isNotEmpty($password)) {
        $_SESSION['alert_message'] = "Username and password cannot empty";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(); // Stop script execution
    }

    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    if (!checkPasswordPattern($password)) {
        $_SESSION['alert_message'] = "Please use strong password(combination of symbols, uppercase lowercase letters.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(); // Stop script execution
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // hash password by password_hash
    $search_user_query = "INSERT INTO users  (username, password)  VALUES (?,?)";
    $s_stmt = $conn->prepare($search_user_query);
    $s_stmt->bind_param("ss", $username, $hashedPassword);
    
    try {
        if ($s_stmt->execute()) {
            $_SESSION['alert_message'] = "Create account successfully.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit(); // Stop script execution
        } else {
            echo "Error: " . $s_stmt->error;
            exit;
        }} catch (Exception $e) {
        // Handle exceptions if they occur during execution
        $_SESSION['alert_message'] = "Please try another username.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(); // Stop script execution
    }
    

    function captchaValidation(){
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
        } else {
            // hCaptcha verification failed 
            $_SESSION['alert_message'] = "hCaptcha verification failed. Please try again.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit(); // Stop script execution
        }
    }
    ?>