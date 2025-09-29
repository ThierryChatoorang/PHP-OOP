<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'ziekmeldingen';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}
?>
