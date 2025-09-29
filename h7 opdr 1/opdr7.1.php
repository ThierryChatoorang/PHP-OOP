<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTW Calculator</title>
</head>
<body>
    <?php
    // Auteur: Thierry Chatoorang
    // Functie: Huiswerk
    // Hoofdstuk 7 - Opdracht 1
    // Datum: 9 januari 2025
    ?>

    <h1>BTW Calculator</h1>
    <form method="post" action="">
        <label for="bedrag">Bedrag exclusief BTW:</label>
        <input type="number" id="bedrag" name="bedrag" step="0.01" required>
        <br><br>

        <label>BTW percentage:</label><br>
        <input type="radio" id="btw9" name="btw" value="9" required>
        <label for="btw9">Laag, 9%</label><br>
        <input type="radio" id="btw21" name="btw" value="21" required>
        <label for="btw21">Hoog, 21%</label><br><br>

        <button type="submit" name="bereken">Berekenen</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bereken'])) {
        // Haal het bedrag en btw-percentage op
        $bedrag = floatval($_POST['bedrag']);
        $btwPercentage = intval($_POST['btw']);

        // Berekening van BTW en totaalbedrag
        $btwBedrag = $bedrag * ($btwPercentage / 100);
        $totaalBedrag = $bedrag + $btwBedrag;

        // Toon het resultaat
        echo "<p>Bedrag exclusief BTW: €" . number_format($bedrag, 2, ',', '.') . "</p>";
        echo "<p>BTW percentage: $btwPercentage%</p>";
        echo "<p>Bedrag inclusief BTW: €" . number_format($totaalBedrag, 2, ',', '.') . "</p>";
    }
    ?>
</body>
</html>
