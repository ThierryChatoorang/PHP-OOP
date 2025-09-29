<?php
// Database gegevens
$servername = "localhost";
$username = "root";  // Verander naar jouw gebruikersnaam
$password = "";      // Verander naar jouw wachtwoord
$dbname = "gastenboek";

try {
    // Maak verbinding
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Zet foutmeldingen aan
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Fout bij verbinden: " . $e->getMessage();
    die();
}
?>