<?php
session_start();
// Logout functionality
if (isset($_POST['logout'])) {
    session_start(); // Start or resume the session
    $_SESSION = array(); // Clear all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to the login page
    exit(); // Stop script execution

}

?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>COVID-19</title>
</head>

<body>
    <h1><strong>COVID-19
        </strong></h1>
    <?php

    // include "login_services.php";
    // Start a session
    

    ?>
    <h2> </h2>
    <?php if (!isset($_SESSION['username'])): ?>
        <p><a href="login_page.php">Login</a></p>
        <p><a href="register_member.php">Register member</a></p>
    <?php else: ?>
        <?php if (($_SESSION['role']) == 'admin'): ?>
            <p><a href="result_table.php">Check all reservation</a></p>
        <?php endif; ?>
        <?php if (($_SESSION['role']) == 'member'): ?>
            <p><a href="create_booking_form.php">Create Reservation</a></p>
            <p><a href="review_booking.php">Review Reservation</a></p>
        <?php endif; ?>


        <p>&nbsp;</p>
        <form method="POST">
            <button type="submit" name="logout">Logout</button>
        </form>
    <?php endif; ?>
</body>

</html>