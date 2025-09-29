<?php
// Inclusie van het database connectie bestand
include 'connect.php';

// Controleren of er een id parameter is meegegeven in de URL
if (!empty($_GET['id'])) {
    // Ophalen van de id parameter uit de URL
    $id = $_GET['id'];

    try {
        // Voorbereiden van de SQL DELETE query met een placeholder voor veiligheid
        $query = "DELETE FROM cijfers WHERE id = :id";
        
        // Voorbereiden van het SQL statement
        $stmt = $pdo->prepare($query);
        
        // Binden van de id parameter aan de placeholder met het juiste datatype (integer)
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Uitvoeren van de query om het record te verwijderen
        $stmt->execute();

        // Doorsturen naar de index pagina na succesvolle verwijdering
        header('Location: index.php');
        exit(); // Stoppen met uitvoeren van de code
    } catch (PDOException $e) {
        // Tonen van een foutmelding als er iets misgaat bij het verwijderen
        echo "Fout bij het verwijderen: " . $e->getMessage();
    }
} else {
    // Tonen van een foutmelding als er geen geldig id is meegegeven
    echo "Geen geldig ID opgegeven!";
}
?>

