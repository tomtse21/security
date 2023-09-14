<?php
include "utils.php";
checkAuthentication();
?>
<?php
session_start();
include("connect_db.php");

if (isset($_POST['submit'])) {
    $hkId = $_POST['hkId'];

    $hkId = $conn->real_escape_string($hkId);
    $table_name = "covid19_table";
    $en_data = encrypt($hkId);

    $search_user_query = "SELECT * from $table_name where hkID = (?)";
    $s_stmt = $conn->prepare($search_user_query);
    $s_stmt->bind_param("s", $en_data);
    $s_stmt->execute();

    $result = $s_stmt->get_result();
    $row = $result->fetch_assoc();


    if (mysqli_num_rows($result) == 1) {

        printInfo($row);

        $result->free();
    } else {
        echo "Error: " . $mysqli->error;
    }

    $mysqli->close();
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

    // Start a session
    

    ?>
    <h2>
        <?php echo !isset($_SESSION['username']); ?>
    </h2>

    <form method="POST">
        <input type="text" name="hkId"> </input>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>

</html>