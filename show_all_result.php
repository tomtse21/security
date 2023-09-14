<?php
include("utils.php");
checkAuthentication();
?>
<?php

include("connect_db.php");

// Query to retrieve data from the UserDetails table
$query = "SELECT * FROM covid19_table";
$result = $conn->query($query);

if ($result) {
    echo "<div class='container'>";
    echo "<h1>Booking record</h1>";
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