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
            session_start();
            include "login_services.php";
            // Start a session
            
            if (mysqli_num_rows($result) == 1) {
                echo "123";
                // User is authenticated, set a session or cookie to remember the user
            } else {
                echo "23";
                // Authentication failed, display an error message
            }

        ?>
    <p><a href="register_member.php">Register member</a></p>
    <p><a href="create_booking_form.php">Create Reservation</a></p>
    <p><a href="review_booking.php">Review Reservation</a></p>
    <p>&nbsp;</p>
</body>

</html>