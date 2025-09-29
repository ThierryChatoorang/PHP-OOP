<?php
// Database instellingen
$host = 'localhost';         // Server naam
$db   = 'poll_systeem';      // Database naam
$user = 'root';              // Gebruikersnaam
$pass = '';                  // Wachtwoord (leeg hier)
$charset = 'utf8mb4';        // Tekencodering

// Maak verbinding met de database
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Toon fouten
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Geef data als array
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Veilige queries
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options); // Start verbinding
} catch (\PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage()); // Toon fout
}
?>