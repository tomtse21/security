<?php
include("../utils.php");
include("../connect_db.php");
session_start();
checkAuthentication();
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
        <h1>COVID-19 vaccination - All Booking Record </h1>
        <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        </style>
        <table>
            <?php
        include ('../admin_back_event.php');
        ?>

            <?php


                // Query to retrieve data from the UserDetails table
                $query = "SELECT * FROM covid19_table";
                $result = $conn->query($query);

                if ($result) {
                    echo "<div class='container'>";
                    echo "<table class='table table-bordered table-striped'>";
                    echo "<thead class='thead-dark'>";
                    echo "<tr><th style='padding:10px'>English Name</th><th style='padding:10px'>Chinese Name</th><th style='padding:10px'>Email</th><th style='padding:10px'>HKID</th><th style='padding:10px'>Phone No</th><th style='padding:10px'>Gender</th><th style='padding:10px'>Date of Birth</th><th style='padding:10px'>Vaccination Date</th><th style='padding:10px'>BOC</th><th style='padding:10px'>Location</th></tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td style='padding:10px'>" . $row['enName'] . "</td>";
                        echo "<td style='padding:10px'>" . $row['cnName'] . "</td>";
                        echo "<td style='padding:10px'>" . $row['email'] . "</td>";
                        echo "<td style='padding:10px'>" . decrypt($row['hkId']) . "</td>";
                        echo "<td style='padding:10px'>" . $row['phoneNo'] . "</td>";
                        echo "<td style='padding:10px'>" . $row['gender'] . "</td>";
                        echo "<td style='padding:10px'>" . $row['dob'] . "</td>";
                        echo "<td style='padding:10px'>" . $row['vaccinationDate'] . "</td>";
                        echo "<td style='padding:10px'>" . $row['boc'] . "</td>";
                        echo "<td style='padding:10px'>" . $row['location'] . "</td>";
                        echo "</tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                    $result->free();
                } else {
                    echo "Error: " . $mysqli->$error;
                }

                $mysqli->close();
                ?>

        </table>
    </div>
</body>

</html>