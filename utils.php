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
    // Message to be encrypted
    $message = $data;

    // Secret key (must be kept secret)
    $secretKey = "YourSecretKey123"; // Replace with your actual secret key

    // Initialization vector (IV) - AES requires a 16-byte IV
    $iv = "RKP71WUFCJ9+3MetsUR1DQ==";

    // Encrypt the message using AES-256 encryption
    $encryptedMessage = openssl_encrypt($message, 'aes-256-cbc', $secretKey, 0, $iv);

    // Encode the IV and encrypted message for safe storage or transmission
    $encodedIV = base64_encode($iv);
    $encodedMessage = base64_encode($encryptedMessage);

    return $encodedMessage;
}

function decrypt($data)
{
    // Encoded IV and encrypted message (obtained from the encryption process)
    $encodedIV = "UktQNzFXVUZDSjkrM01ldHNVUjFEUT09"; // Replace with your actual IV
    $encodedMessage = $data; // Replace with your actual encrypted message

    // Secret key (must match the one used for encryption)
    $secretKey = "YourSecretKey123"; // Replace with your actual secret key

    // Decode the IV and encrypted message from base64
    $iv = base64_decode($encodedIV);
    $encryptedMessage = base64_decode($encodedMessage);

    // Decrypt the message using AES-256 decryption
    $decryptedMessage = openssl_decrypt($encryptedMessage, 'aes-256-cbc', $secretKey, 0, $iv);



    return $decryptedMessage;
}

function getAddr($a)
{
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
    return $localArray[$a];
}

function printInfo($data)
{


    echo "<div class='container'>";
    echo "<h1>Reservation for COVID-19 record!</h1>";
    echo "<p style='font-size:12px'>Please attend on time. If you have any questions, please feel free to call us Tel: 2222 2222.</p>";
    echo "<form>";
    echo "<form>";
    echo "<div class='form-group'>";
    echo "<label for='enName'>English Name:</label>";
    echo "<input type='text' id='enName' name='enName' class='form-control' value='" . $data['enName'] . "' disabled>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='cnName'>Chinese Name:</label>";
    echo "<input type='text' id='cnName' name='cnName' class='form-control' value='" . $data['cnName'] . "' disabled>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='phoneNo'>Phone No:</label>";
    echo "<input type='text' id='phoneNo' name='phoneNo' class='form-control' value='" . $data['phoneNo'] . "' disabled>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='gender'>Gender:</label>";
    echo "<input type='text' id='gender' name='gender' class='form-control' value='" . $data['gender'] . "' disabled>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='vaccinationDate'>Vaccination Date:</label>";
    echo "<input type='text' id='vaccinationDate' name='vaccinationDate' class='form-control' value='" . $data['vaccinationDate'] . "' disabled>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='location'>Location:</label>";
    echo " <textarea id='textareaContent' class='form-control' name='textareaContent' rows='4' cols='50' disabled>" . getAddr($data['location']) . " </textarea>";

  
    echo "</form>";
    echo "<br>";
    echo "</form>";
    echo "<br>";
}

function checkAuthentication()
{
    session_start(); // Start or resume the session
    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
        // User is not authenticated, redirect to the login page
        header("Location: login_page.php");
        exit(); // Stop script execution
    }
}
function isValidEmail($email)
{
    // Regular expression for a valid email address
    $emailPattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';

    // Test the email against the pattern
    return preg_match($emailPattern, $email);
}

function isValidHKID($hkid)
{
    // Regular expression pattern for HKID
    $hkidPattern = '/^[A-Z]\d{6}([0-9A])?$/';

    return preg_match($hkidPattern, $hkid);
}
?>