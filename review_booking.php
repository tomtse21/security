<?php
include("connect_db.php");
include("utils.php");

if (isset($_POST['submit'])) {
    $hkId = $_POST['hkid'];
    $enName = $_POST['enName'];
    $dob = $_POST['dob'];
    $hkId = $conn->real_escape_string($hkId);
    $enName = $conn->real_escape_string($enName);
    $dob = $conn->real_escape_string($dob);

    
    if (!isValidHKID($hkId)) {
        echo "<script> alert('Wrong HKID format')</script>";
        echo '<script>window.history.back();</script>';
    }
    if (!nameCheckSymbol($enName)){
        echo "<script> alert('Wrong name format')</script>";
        echo '<script>window.history.back();</script>';
    }

    $table_name = "covid19_table";
    $en_data = encrypt($hkId);
    
    $search_user_query = "SELECT * from $table_name where hkID = (?) and enName = (?) and dob = (?) ";
    $s_stmt = $conn->prepare($search_user_query);
    $s_stmt->bind_param("sss", $en_data,$enName,$dob);

    $numRows = 0;
    if ($s_stmt->execute()) {
        // Get the result set
        $result = $s_stmt->get_result();
        // Get the number of rows returned
        $numRows = $result->num_rows;

    }
    $row = $result->fetch_assoc();
    
    if ($numRows == 1) {

        printInfo($row);

        $result->free();
    } else {
        noDataFoundAndBackPage();
        $mysqli->close();
        
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
    <script src="index.js"></script>
</head>

<body>
    <div class="container" style="margin-top:50px">
        <h1>COVID-19 vaccination - Review Reservation </h1>
        <form method="POST">
            <div class="form-group">
                <label for="hkid">HKID</label>
                <input type="text" class="form-control"  id="hkid" name="hkid"  maxlength="8"  placeholder="e.g(A1234567)" required> </input>
            </div>
             <div class="form-group">
                <label for="enName">English Name:</label>
                <input type="text" class="form-control" id="enName" name="enName" pattern="[A-Za-z ]*"  placeholder="e.g(CHAN TAI MAN)"required>
            </div>
             <div class="form-group">
                <label for="dob">Date of birth:</label>
                <input type="text" class="form-control" id="dob" name="dob" placeholder="mm/dd/yyy" required>
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>