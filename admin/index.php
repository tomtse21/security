<?php
session_start();

// Logout functionality
if (!isset($_SESSION['role']) || isset($_POST['logout'])) {
    session_start(); // Start or resume the session
    $_SESSION = array(); // Clear all session variables
    session_destroy(); // Destroy the session
    header("Location: ./login_page.php"); // Redirect to the login page
    exit(); // Stop script execution

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>COVID-19 vaccination booking system </title>

    <!-- Include Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <!-- Include Bootstrap CSS from a CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Bootstrap Datepicker CSS and JavaScript files -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- ✅ load jQuery ✅ -->
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Include jQuery UI from a CDN -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
    <div class="container" style="margin-top:50px">

        <h1>COVID-19 Admin System</h1>
        <?php
        echo "<p> Hello, " . $_SESSION['username'] . " | <b>Role: [" . $_SESSION['role'], "]</b></p>";
        ?>
        <h2> </h2>

        <?php if (($_SESSION['role']) == 'admin'): ?>
        <p><a href="register_member.php">Register Staff</a></p>
        <p><a href="member_control_page.php">Manage Staff account</a></p>
        <p><a href="show_all_result.php">Check all reservation</a></p>


        <?php elseif (($_SESSION['role']) == 'staff'): ?>
        <p><a href="../review_booking.php">Review Reservation</a></p>
        <?php else: ?>

        <?php endif; ?>
        <p>&nbsp;</p>
        <form method="POST">
            <button type="submit" class="btn btn-primary" name="logout">Logout</button>
        </form>

    </div>
</body>

</html>