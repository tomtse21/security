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
    echo "<tr><th>English Name</th><th>Chinese Name</th><th>Email</th><th>HKID</th><th>Phone No</th><th>Gender</th><th>Date of Birth</th><th>Vaccination Date</th><th>BOC</th><th>Location</th></tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['enName'] . "</td>";
        echo "<td>" . $row['cnName'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['hkId'] . "</td>";
        echo "<td>" . $row['phoneNo'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td>" . $row['dob'] . "</td>";
        echo "<td>" . $row['vaccinationDate'] . "</td>";
        echo "<td>" . $row['boc'] . "</td>";
        echo "<td>" . $row['location'] . "</td>";
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