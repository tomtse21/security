<?php
include("connect_db.php");
include("utils.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation completed! </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <script>
        // Disable the back button in the browser
        // history.pushState(null, null, location.href);
        // window.onpopstate = function () {
        //     history.go(1);
        // };
    </script>
    <div class="container">
        <?php

       
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Retrieve and sanitize form data
            $enName = $_POST["enName"];
            $cnName = $_POST["cnName"];
            $email = $_POST["email"];
            $hkid = $_POST["hkid"];
            $phoneNo = $_POST["phoneNo"];
            $gender = $_POST["gender"];
            $dob = $_POST["dob"];
            $vaccinationDate = $_POST["vaccinationDate"];
            $boc = $_POST["boc"];
            $location = $_POST["location"];

            // SQL Injection prevention
            $enName = $conn->real_escape_string($enName);
            $cnName = $conn->real_escape_string($cnName);
            $hkid = $conn->real_escape_string($hkid);
            $email = $conn->real_escape_string($email);
            $phoneNo = $conn->real_escape_string($phoneNo);
            $gender = $conn->real_escape_string($gender);
            $dob = $conn->real_escape_string($dob);
            $vaccinationDate = $conn->real_escape_string($vaccinationDate);
            $boc = $conn->real_escape_string($boc);
            $location = $conn->real_escape_string($location);

            validation($enName,$hkid,$email);
            
            $table_name = "covid19_table";
            $en_data = encrypt($hkid);

            $de_data = decrypt($en_data);

            $search_sql = "SELECT * from $table_name where hkID = (?) and enName = (?) and dob = (?) ";
            $s_stmt = $conn->prepare($search_sql);
            $s_stmt->bind_param("sss", $en_data, $enName, $dob);

            $s_stmt->execute();


            $result = $s_stmt->get_result();
            $row = $result->fetch_assoc();

            if (mysqli_num_rows($result) == 1) {
                printInfo($row);
                exit;
            } else {
                // insert
                $sql = "INSERT INTO $table_name (enName, cnName,hkId, email, phoneNo, gender, dob, vaccinationDate, boc, location)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssisssss", $enName, $cnName, $en_data, $email, $phoneNo, $gender, $dob, $vaccinationDate, $boc, $location);
                if ($stmt->execute()) {
                } else {
                    echo "Error: " . $stmt->error;
                }
            }

            echo "<div class='container'>";
            echo "<h1>Reservation completed !</h1>";
            echo "<p style='font-size:12px'>Please attend on time. If you have any questions, please feel free to call us Tel: 2222 2222.</p>";
            echo "<form>";
            echo "<form>";
            echo "<div class='form-group'>";
            echo "<label for='enName'>English Name:</label>";
            echo "<input type='text' id='enName' name='enName' class='form-control' value='" . $enName . "' disabled>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='cnName'>Chinese Name:</label>";
            echo "<input type='text' id='cnName' name='cnName' class='form-control' value='" . $cnName . "' disabled>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='phoneNo'>Phone No:</label>";
            echo "<input type='text' id='phoneNo' name='phoneNo' class='form-control' value='" . $phoneNo . "' disabled>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='gender'>Gender:</label>";
            echo "<input type='text' id='gender' name='gender' class='form-control' value='" . $gender . "' disabled>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='vaccinationDate'>Vaccination Date:</label>";
            echo "<input type='text' id='vaccinationDate' name='vaccinationDate' class='form-control' value='" . $vaccinationDate . "' disabled>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='location'>Location:</label>";

            echo " <textarea id='textareaContent' class='form-control' name='textareaContent' rows='4' cols='50' disabled>" . getAddr($location) . " </textarea>";


            echo "</div>";


            echo "</form>";
            echo "<br>";
            echo "</form>";
            echo "<br>";

            // Close the database connection
            $stmt->close();
            $conn->close();
        } else {
            echo "Form has not been submitted.";
        }
        ?>
    </div>
</body>

</html>