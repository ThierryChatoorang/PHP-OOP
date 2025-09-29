<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
</head>
<body>
    <?php
    // Auteur: Thierry Chatoorang
    // Functie: Huiswerk
    // Hoofdstuk 7 - Opdracht 2
    // Datum: Datum: 09-01-2025
    ?>

    <h1>Rekenmachine</h1>
    <form method="post" action="">
        <label for="getal1">Getal 1:</label>
        <input type="number" id="getal1" name="getal1" step="0.01" required>
        <br><br>

        <label for="getal2">Getal 2:</label>
        <input type="number" id="getal2" name="getal2" step="0.01" required>
        <br><br>

        <label>Bewerking:</label><br>
        <input type="radio" id="optellen" name="bewerking" value="+" required>
        <label for="optellen">Optellen</label><br>
        <input type="radio" id="aftrekken" name="bewerking" value="-" required>
        <label for="aftrekken">Aftrekken</label><br>
        <input type="radio" id="vermenigvuldigen" name="bewerking" value="*" required>
        <label for="vermenigvuldigen">Vermenigvuldigen</label><br>
        <input type="radio" id="delen" name="bewerking" value="/" required>
        <label for="delen">Delen</label><br><br>

        <button type="submit" name="bereken">Berekenen</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bereken'])) {
        // Haal de invoerwaarden op
        $getal1 = floatval($_POST['getal1']);
        $getal2 = floatval($_POST['getal2']);
        $bewerking = $_POST['bewerking'];
        $resultaat = null;

        // Controleer en voer de berekening uit
        if ($bewerking === '+') {
            $resultaat = $getal1 + $getal2;
        } elseif ($bewerking === '-') {
            $resultaat = $getal1 - $getal2;
        } elseif ($bewerking === '*') {
            $resultaat = $getal1 * $getal2;
        } elseif ($bewerking === '/' && $getal2 != 0) {
            $resultaat = $getal1 / $getal2;
        } else {
            echo "<p>Kan niet delen door nul!</p>";
        }

        // Toon het resultaat
        if ($resultaat !== null) {
            echo "<p>Resultaat: $getal1 $bewerking $getal2 = " . number_format($resultaat, 2, ',', '.') . "</p>";
        }
    }
    ?>
</body>
</html>
