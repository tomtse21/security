<?php
include("../connect_db.php");
include("../utils.php");

?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    // $secretKey = 'ES_47641e8e62fd461392936d2b0e4a6ef1';

    // // Verify hCaptcha response
    // $response = $_POST['h-captcha-response'];
    // $url = 'https://hcaptcha.com/siteverify';
    // $data = [
    //     'secret' => $secretKey,
    //     'response' => $response,
    // ];

    // $options = [
    //     'http' => [
    //         'header' => 'Content-type: application/x-www-form-urlencoded',
    //         'method' => 'POST',
    //         'content' => http_build_query($data),
    //     ],
    // ];
    // $context = stream_context_create($options);
    // $result = file_get_contents($url, false, $context);
    // $jsonResult = json_decode($result);

    // if ($jsonResult->success) {
    //     // hCaptcha verification successful
    //     // Proceed with user registration logic
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];

    //     // Your registration logic goes here
    // } else {
    //     // hCaptcha verification failed
    //     echo "hCaptcha verification failed. Please try again.";
    //     header("Location: register_member.php"); // Redirect to the login page
    //     exit(); // Stop script execution

    // }

    // Get the raw POST data from the request body
    $json = file_get_contents('php://input');

    // Parse the JSON data into a PHP associative array
    $data = json_decode($json, true);

    // Check if JSON decoding was successful
    if ($data === null) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON']);
    } else {

        /* Get form data */
        $username = $data['username'];
        $password = $data['password'];

        if (!isNotEmpty($username) && !isNotEmpty($password)) {
            returnJsonResponse(false, "Please enter username or password", null);
        }

        $username = $conn->real_escape_string($username);
        $password = $conn->real_escape_string($password);

        if (!checkPasswordPattern($password)) {
            returnJsonResponse(false, "Please use strong password(combination of symbols, uppercase lowercase letters.", null);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // hash password by password_hash
        $search_user_query = "INSERT INTO users  (username, password)  VALUES (?,?)";
        $s_stmt = $conn->prepare($search_user_query);
        $s_stmt->bind_param("ss", $username, $hashedPassword);

        if ($s_stmt->execute()) {

            $_SESSION['username'] = $username;
            returnJsonResponse(true, "Created member successfully.", null);

        } else {

            echo json_encode($response);
        }
    }

}else {
    // If the request is not POST, return an error
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}
?>