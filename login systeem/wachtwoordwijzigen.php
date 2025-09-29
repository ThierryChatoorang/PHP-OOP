<?php 
// Inclusief configuratiebestand met database instellingen
require_once('config.php');  

// Start een nieuwe sessie of hervat de bestaande sessie
session_start();  

try {
    // Maak verbinding met de database
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    
    // Voer query uit om alle gebruikersnamen op te halen
    $query = $db->query("SELECT username FROM gebruikers");
    
    // Haal alle resultaten op als een associatieve array
    $gebruikers = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Toon een foutmelding als er een probleem is met de database
    die("Error: " . $e->getMessage());
} 
?>  

<!DOCTYPE html> 
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord wijzigen</title> 
</head> 
<body>
    <!-- Titel van het formulier -->
    <h2>Wachtwoord wijzigen voor gebruikers</h2>
    
    <!-- Formulier dat naar verwerkingwachtwoord.php verwijst voor verwerking -->
    <form action="verwerkingwachtwoord.php" method="post">
        <div>
            <!-- Dropdown menu voor het selecteren van een gebruiker -->
            <label for="username">Select gebruiker:</label><br>
            <select name="username" id="username" required>
                <?php foreach ($gebruikers as $gebruiker): ?>
                    <!-- Genereer een optie voor elke gebruiker in de database -->
                    <option value="<?= htmlspecialchars($gebruiker["username"]) ?>"><?= htmlspecialchars($gebruiker["username"]) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <!-- Inputveld voor het nieuwe wachtwoord -->
            <label for="newPassword">Nieuw Wachtwoord:</label><br>
            <input type="password" name="newPassword" id="newPassword" required>
        </div>
        <div>
            <!-- Verzendknop voor het formulier -->
            <input type="submit" name="wijzigen" value="Wachtwoord Wijzigen">
        </div>
    </form> 
</body> 
</html>
  