<?php
echo encrypt("This is a secret message.");
// deencrypt();
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

?>