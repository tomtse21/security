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

        $localArray = array(
            'addr1' => 'CENTRAL- Club Lusitano -16
                        Ice House Street (7/F) (Entrance
                        at Duddell Street) - by Marina
                        Medical',
            'addr2' => 'CENTRAL - 9 Queen"s Road
                        Central (Room 2101) - by
                        Humanity & Health (Sinovac)',
            'addr3' => 'CAUSEWAY BAY - Sino Plaza,
                        255 Gloucester Road (11/F) - by
                        HKIPHCA ',
            'addr4' => 'CENTRAL - 9 Queen"s Road
                        Central (Room 2101) - by
                        Humanity & Health (Sinovac) ',
            'addr5' => 'WONG CHUK HANG - 1 Nam
                        Fung Path (1/F, Tower A) -
                        Gleneagles Hospital Hong Kong
                        (BioNTech - Toddler/ Paediatric)',
            'addr6' => 'HUNG HOM-1 Wu Kwong
                        Street (Shop 11) - by Dr. Leung
                        Shu Piu Clinic ',
            'addr7' => 'KOWLOON BAY - The
                        Quayside, 77 Hoi Bun Road
                        (Shop 7, 2/F) - by Quality
                        Healthcare'
            // Add more options as needed
        );

        function encrypt($data)
        {
            // Generate a random encryption key (session key)
            $encryptionKey = openssl_random_pseudo_bytes(32);

            // Recipient's public key (replace with the actual public key)
            $recipientPublicKey = file_get_contents('mypublic.pem');

            // Seal (encrypt) the data for the recipient
            if (openssl_seal($data, $sealedData, $ekeys, array($recipientPublicKey), "AES256", $encryptionKey)) {
                // $sealedData now contains the sealed (encrypted) data
                // $ekeys contains the encrypted session key(s)
                // Save the sealed data and encrypted session key(s) for each recipient
                return $sealedData;
                // To decrypt the data, the recipient would use their private key and the session key
            } else {
                echo "Encryption failed.";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $conn = mysqli_connect("localhost", "root", "", "covid19_db");

            // Check for database connection errors
            if ($conn->connect_error) {
                die("Database connection failed: " . $conn->connect_error);
            }

            // Retrieve and sanitize form data
            $enName = $_POST["enName"];
            $cnName = $_POST["cnName"];
            $email = $_POST["email"];
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

            $encrupt_hkid = encrypt($hkid);

            // echo $vaccinationDate;
        
            // echo $boc;
            // Prepare and execute the SQL query
            $sql = "INSERT INTO covid19_table (enName, cnName,hkid, email, phoneNo, gender, dob, vaccinationDate, boc, location)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("ssssisssss", $enName, $cnName, $encrupt_hkid, $email, $phoneNo, $gender, $dob, $vaccinationDate, $boc, $location);

            // return false;
            if ($stmt->execute()) {
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

                echo " <textarea id='textareaContent' class='form-control' name='textareaContent' rows='4' cols='50' disabled>" . $localArray[$location] . " </textarea>";


                echo "</div>";

                echo "<button onclick='print()' class='btn btn-primary'>Print</button>";
                echo "</form>";
                echo "<br>";
                echo "</form>";
                echo "<br>";
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

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