<?php
// Database verbinding
require_once 'connect.php';

// Formulier verwerken
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $bericht = $_POST['bericht'];
    
    if (!empty($naam) && !empty($bericht)) {
        // Bericht toevoegen aan database
        $sql = "INSERT INTO berichten (naam, bericht) VALUES ('$naam', '$bericht')";
        $conn->query($sql);
        echo "Bericht toegevoegd!";
    } else {
        echo "Vul alle velden in.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gastenboek</title>
</head>
<body>
    <h1>Gastenboek</h1>
    
    <!-- Formulier -->
    <form method="post">
        <p>Naam:<br>
        <input type="text" name="naam"></p>
        
        <p>Bericht:<br>
        <textarea name="bericht" rows="4" cols="30"></textarea></p>
        
        <p><input type="submit" value="Verzenden"></p>
    </form>
    
    <h2>Berichten</h2>
    <?php
    // Berichten ophalen
    $sql = "SELECT id, naam, bericht, datumtijd FROM berichten ORDER BY datumtijd DESC";
    $result = $conn->query($sql);
    
    // Berichten tonen
    while($row = $result->fetch()) {
        echo "<div>";
        echo "<p><b>" . $row['naam'] . "</b> op " . date('d-m-Y H:i', strtotime($row['datumtijd']));
        
        // Voeg verwijderlink toe bij elk bericht
        echo " <small>[<a href='delete.php?id=" . $row['id'] . "'>Verwijderen</a>]</small>";
        
        echo "</p>";
        echo "<p>" . nl2br($row['bericht']) . "</p>";
        echo "<hr>";
        echo "</div>";
    }
    ?>
</body>
</html>