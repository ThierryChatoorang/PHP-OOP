<?php
require 'connect.php';

// Controleer of poll-ID bestaat
if (!isset($_GET['id'])) {
    header("Location: beheer.php");
    exit;
}

$poll_id = $_GET['id']; // Haal poll-ID uit URL

// Haal poll op uit database
$poll = $pdo->prepare("SELECT * FROM polls WHERE id = ?");
$poll->execute([$poll_id]);
$poll = $poll->fetch();

// Als poll niet bestaat: terug naar beheer
if (!$poll) {
    header("Location: beheer.php");
    exit;
}

// Haal opties van deze poll op
$options = $pdo->prepare("SELECT * FROM options WHERE poll_id = ?");
$options->execute([$poll_id]);
$options = $options->fetchAll();

$errors = []; // Foutenlijst

// Verwerk formulier als het is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = trim($_POST['question']); // Nieuwe vraag
    $new_options = array_map('trim', $_POST['options']); // Nieuwe opties
    
    // Controleer of vraag is ingevuld
    if (empty($question)) {
        $errors[] = 'Vraag is verplicht';
    }
    
    // Filter lege opties
    $valid_options = array_filter($new_options, function($opt) {
        return !empty($opt);
    });
    
    // Controleer op minimaal 2 opties
    if (count($valid_options) < 2) {
        $errors[] = 'Minstens 2 opties zijn verplicht';
    }
    
    // Als geen fouten: update database
    if (empty($errors)) {
        // Update poll vraag
        $stmt = $pdo->prepare("UPDATE polls SET question = ? WHERE id = ?");
        $stmt->execute([$question, $poll_id]);
        
        // Update bestaande opties of voeg nieuwe toe
        foreach ($_POST['option_ids'] as $index => $option_id) {
            if (!empty($new_options[$index])) {
                if ($option_id > 0) {
                    // Bestaande optie updaten
                    $stmt = $pdo->prepare("UPDATE options SET option_text = ? WHERE id = ?");
                    $stmt->execute([$new_options[$index], $option_id]);
                } else {
                    // Nieuwe optie toevoegen
                    $stmt = $pdo->prepare("INSERT INTO options (poll_id, option_text) VALUES (?, ?)");
                    $stmt->execute([$poll_id, $new_options[$index]]);
                }
            } elseif ($option_id > 0) {
                // Lege optie verwijderen
                $stmt = $pdo->prepare("DELETE FROM options WHERE id = ?");
                $stmt->execute([$option_id]);
            }
        }
        
        header("Location: beheer.php"); // Ga terug naar beheer
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<body>
    <h1>Poll bewerken</h1>
    
    <!-- Toon fouten -->
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <!-- Bewerkformulier -->
    <form method="post">
        <div>
            <label>Vraag:</label>
            <input type="text" name="question" value="<?= htmlspecialchars($poll['question']) ?>" required>
        </div>
        
        <div>
            <label>Opties (minimaal 2):</label>
            <?php foreach ($options as $option): ?>
                <!-- Verborgen ID van optie -->
                <input type="hidden" name="option_ids[]" value="<?= $option['id'] ?>">
                <!-- Optieveld -->
                <input type="text" name="options[]" value="<?= htmlspecialchars($option['option_text']) ?>" required>
            <?php endforeach; ?>
            <!-- Voeg lege velden toe tot 4 -->
            <?php for ($i = 0; $i < (4 - count($options)); $i++): ?>
                <input type="hidden" name="option_ids[]" value="0">
                <input type="text" name="options[]" value="">
            <?php endfor; ?>
        </div>
        
        <button type="submit">Opslaan</button> <!-- Verstuur wijzigingen -->
    </form>
    
    <a href="beheer.php">Terug</a> <!-- Terug naar beheer -->
</body>
</html>