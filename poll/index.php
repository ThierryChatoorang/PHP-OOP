<?php
require 'connect.php';

// Verwerk een stem als het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['poll_id']) && isset($_POST['option_id'])) {
    $stmt = $pdo->prepare("UPDATE options SET votes = votes + 1 WHERE id = ? AND poll_id = ?");
    $stmt->execute([$_POST['option_id'], $_POST['poll_id']]);
    header("Location: index.php"); // Vernieuw de pagina
    exit;
}

// Haal alle polls op met hun opties
$polls = $pdo->query("SELECT * FROM polls ORDER BY created_at DESC")->fetchAll();

foreach ($polls as &$poll) {
    // Haal opties voor elke poll op
    $stmt = $pdo->prepare("SELECT * FROM options WHERE poll_id = ?");
    $stmt->execute([$poll['id']]);
    $poll['options'] = $stmt->fetchAll();
    
    // Bereken totaal aantal stemmen
    $poll['total_votes'] = array_sum(array_column($poll['options'], 'votes'));
}
unset($poll); // Reset variabele
?>

<!DOCTYPE html>
<html lang="nl">
<body>
    <h1>Poll</h1>

    <!-- Toon elke poll -->
    <?php foreach ($polls as $poll): ?>
        <div class="poll">
            <h2><?= htmlspecialchars($poll['question']) ?></h2> <!-- Poll vraag -->
            
            <!-- Stemformulier -->
            <form method="post">
                <input type="hidden" name="poll_id" value="<?= $poll['id'] ?>">
                <?php foreach ($poll['options'] as $option): ?>
                    <div class="option">
                        <!-- Keuzerondje voor optie -->
                        <input type="radio" name="option_id" value="<?= $option['id'] ?>">
                        <label><?= htmlspecialchars($option['option_text']) ?></label>
                    </div>
                <?php endforeach; ?>
                <button type="submit">Stem</button> <!-- Verstuur stem -->
            </form>
            
            <!-- Toon resultaten als er stemmen zijn -->
            <?php if ($poll['total_votes'] > 0): ?>
                <div class="results">
                    <h3>Tussenstand</h3>
                    <?php foreach ($poll['options'] as $option): 
                        $percentage = round(($option['votes'] / $poll['total_votes']) * 100, 2);
                    ?>
                        <div class="result-item">
                            <?= htmlspecialchars($option['option_text']) ?>: 
                            <?= $option['votes'] ?> stemmen (<?= $percentage ?>%)
                            <!-- Progress bar -->
                            <div class="progress-bar">
                                <div class="progress" style="width: <?= $percentage ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <a href="beheer.php">Vragen beheren</a> <!-- Link naar beheerpagina -->
</body>
</html>