<?php
// Start of hervat de sessie
include("config.php");
session_start();

// Controleer of de sessievariabele bestaat
if (!isset($_SESSION['gebruikersnaam'])) {
    header("Location: inloggen.php");
    exit();
}

// Haal de gebruikersnaam op uit de sessie
$gebruikersnaam = $_SESSION['gebruikersnaam'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom</title>
</head>
<body>
    <h1>Welkom <?php echo htmlspecialchars($gebruikersnaam); ?>!</h1>
    <p>Je bent succesvol ingelogd.</p>

    <?php
    // Optioneel: als de gebruiker admin is, toon een link om het wachtwoord te wijzigen
    if ($gebruikersnaam == 'admin') {
        echo '<p><a href="wachtwoordwijzigen.php">Wachtwoord wijzigen</a></p>';
    }
    ?>

    <p><a href="logout.php">Uitloggen</a></p>
</body>
</html>


