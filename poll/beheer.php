<?php
require 'connect.php';

// Verwijder een poll als op "verwijderen" is geklikt
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM polls WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: beheer.php"); // Vernieuw de pagina
    exit;
}

// Haal alle polls op uit de database
$polls = $pdo->query("SELECT * FROM polls ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<body>
    <h1>Vragen beheren</h1>
    
    <!-- Toon alle polls -->
    <div class="poll-list">
        <?php foreach ($polls as $poll): ?>
            <div class="poll-item">
                <h3><?= htmlspecialchars($poll['question']) ?></h3> <!-- Poll vraag -->
                <div class="actions">
                    <!-- Link om poll te bewerken -->
                    <a href="update.php?id=<?= $poll['id'] ?>">Bewerken</a>
                    <!-- Link om poll te verwijderen (met bevestiging) -->
                    <a href="beheer.php?delete=<?= $poll['id'] ?>" onclick="return confirm('Weet je het zeker?')">Verwijderen</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <a href="insert.php">Nieuwe poll toevoegen</a> <!-- Link naar toevoegpagina -->
    <br>
    <a href="index.php">Terug naar polls</a> <!-- Terug naar hoofdpagina -->
</body>
</html>