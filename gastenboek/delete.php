<?php
// Verbind met database
require_once 'connect.php';

// Check of ID bestaat
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Bereid query voor
        $stmt = $conn->prepare("DELETE FROM berichten WHERE id = :id");
        
        // Voeg ID toe
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Voer query uit
        $stmt->execute();
        
        // Ga terug naar hoofdpagina
        header("Location: hoofd.php");
        exit();
    } catch(PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
} else {
    echo "Geen geldig ID.";
    echo "<p><a href='hoofd.php'>Terug naar gastenboek</a></p>";
}
?>