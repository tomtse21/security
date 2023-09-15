<?php
include("../connect_db.php");
include("../utils.php");
?>
<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);



$search_user_query = "SELECT * FROM users WHERE username = (?)";
$s_stmt = $conn->prepare($search_user_query);
$s_stmt->bind_param("s", $username);
$s_stmt->execute();

$numRows = 0;
if ($s_stmt->execute()) {
    // Get the result set
    $result = $s_stmt->get_result();
    // Get the number of rows returned
    $numRows = $result->num_rows;

}

$row = $result->fetch_assoc();
if ($numRows == 1) {

    $_SESSION['username'] = $username;
    $_SESSION['authenticated'] = true;
    $_SESSION['role'] = $row['role'];

    session_regenerate_id();
    // Regenerate the session ID to prevent session fixation

    if (password_verify($password, $row['password'])) {
        error_log("user enter");
        header('Location: ./index.php');
    } else {
        echo "Access Deny";
    }

    exit;

} else {
    wrongInfoAndBackPage();
}


?>