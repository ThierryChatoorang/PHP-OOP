<?php
include 'connect.php';

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verkrijg de gegevens uit het formulier
    $leerling = $_POST['leerling'];
    $cijfer = $_POST['cijfer'];
    $vak = $_POST['vak'];
    $docent = $_POST['docent'];

    // Valideer de invoer
    if (empty($leerling) || empty($cijfer) || empty($vak) || empty($docent)) {
        $error = "Alle velden moeten ingevuld worden.";
    } else {
        // Voeg de gegevens toe aan de database
        $query = "INSERT INTO cijfers (leerling, cijfer, vak, docent) VALUES (:leerling, :cijfer, :vak, :docent)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'leerling' => $leerling, 
            'cijfer' => $cijfer, 
            'vak' => $vak, 
            'docent' => $docent
        ]);

        // Redirect naar index.php na invoeren
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuw Cijfer Invoeren</title>
</head>
<body>
    <h1>Nieuw Cijfer Invoeren</h1>

    <!-- Foutmelding tonen als velden leeg zijn -->
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post" action="invoeren.php">
        <label for="leerling">Leerling:</label>
        <input type="text" name="leerling" id="leerling" required><br><br>
        
        <label for="cijfer">Cijfer:</label>
        <input type="number" name="cijfer" id="cijfer" step="0.1" required><br><br>
        
        <label for="vak">Vak:</label>
        <input type="text" name="vak" id="vak" required><br><br>
        
        <label for="docent">Docent:</label>
        <input type="text" name="docent" id="docent" required><br><br>
        
        <button type="submit">Invoeren</button>
    </form>

    <br>
    <a href="index.php">Terug naar overzicht</a>
</body>
</html>


