<?php
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
        <h1>COVID-19 vaccination - Review Reservation </h1>
        <form method="POST">
            <div class="form-group">
                <label for="hkId">HKID</label>
                <input type="text" class="form-control"  name="hkId" required> </input>
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>