<?php
session_start();

if (!isset($_SESSION["gebruikersnaam"]) || $_SESSION["gebruikersnaam"] !== "admin") {
    header("Location: inloggen.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welkom, admin!</h1>
    <p>Je bent succesvol ingelogd.</p>
    <p><a href="wachtwoordwijzigen.php">Admin kan wachtwoorden wijzigen</a></p>
    <p><a href="logout.php">Uitloggen</a></p>
</body>
</html>
