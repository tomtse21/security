<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Student Success!</title>
</head>

<body>
<?php

/* conect to database */
include("connect_db.php");

/* Get form data */
$username = $_POST['username'];
$password = $_POST['password'];
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

$search_user_query = "INSERT INTO users  (username, password)  VALUES (?,?)";
$s_stmt = $conn->prepare($search_user_query);
$s_stmt->bind_param("ss", $username,$password);


   if ($s_stmt->execute()) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
    } else {
        echo "Error: " . $s_stmt->error;
    }

?>
<p>Add student success!</p>
<p><a href="index.php">Go back to index page</a></p>
</body>
</html>