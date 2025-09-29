<?php
require 'connect.php';

$errors = []; // Foutenlijst
$question = ''; // Lege vraag
$options = ['', '', '', '']; // 4 lege opties

// Verwerk formulier als het is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = trim($_POST['question']); // Haal vraag op
    $options = array_map('trim', $_POST['options']); // Haal opties op
    
    // Controleer of vraag is ingevuld
    if (empty($question)) {
        $errors[] = 'Vraag is verplicht';
    }
    
    // Filter lege opties
    $valid_options = array_filter($options, function($opt) {
        return !empty($opt);
    });
    
    // Controleer op minimaal 2 opties
    if (count($valid_options) < 2) {
        $errors[] = 'Minstens 2 opties zijn verplicht';
    }
    
    // Als geen fouten: sla op
    if (empty($errors)) {
        // Sla poll op
        $stmt = $pdo->prepare("INSERT INTO polls (question) VALUES (?)");
        $stmt->execute([$question]);
        $poll_id = $pdo->lastInsertId(); // Haal nieuw poll-ID op
        
        // Sla opties op
        $stmt = $pdo->prepare("INSERT INTO options (poll_id, option_text) VALUES (?, ?)");
        foreach ($valid_options as $option) {
            $stmt->execute([$poll_id, $option]);
        }
        
        header("Location: beheer.php"); // Ga terug naar beheer
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<body>
    <h1>Nieuwe poll toevoegen</h1>
    
    <!-- Toon fouten -->
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <!-- Toevoegformulier -->
    <form method="post">
        <div>
            <label>Vraag:</label>
            <input type="text" name="question" value="<?= htmlspecialchars($question) ?>" required>
        </div>
        
        <div>
            <label>Opties (minimaal 2):</label>
            <?php for ($i = 0; $i < 4; $i++): ?>
                <!-- Optievelden (eerste 2 verplicht) -->
                <input type="text" name="options[]" value="<?= htmlspecialchars($options[$i]) ?>" <?= $i < 2 ? 'required' : '' ?>>
            <?php endfor; ?>
        </div>
        
        <button type="submit">Opslaan</button> <!-- Verstuur formulier -->
    </form>
    
    <a href="beheer.php">Terug</a> <!-- Terug naar beheer -->
</body>
</html>