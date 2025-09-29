<?php
$host = "localhost";  // Database host (meestal localhost bij XAMPP)
$dbname = "cijfer"; // Vervang dit met de naam van je database
$username = "root";  // Standaard bij XAMPP is dit 'root'
$password = ""; // Bij XAMPP is er standaard geen wachtwoord

try {
    // Maak de PDO-verbinding aan en stel de foutmodus in op Exception
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Fout bij verbinden met de database: " . $e->getMessage());
}
?>
