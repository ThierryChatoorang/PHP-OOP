<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korting Berekenen</title>
</head>
<body>
    <h1>Korting Berekenen</h1>
    <form method="post" action="">
        <!-- Invoer voor het geldbedrag -->
        <label for="bedrag">Geldbedrag (€):</label>
        <input type="number" step="0.01" id="bedrag" name="bedrag" required>
        <br><br>

        <!-- Invoer voor het kortingspercentage -->
        <label for="korting">Kortingspercentage (%):</label>
        <input type="number" step="0.01" id="korting" name="korting" required>
        <br><br>

        <!-- Knop om de korting te berekenen -->
        <button type="submit">Uitrekenen</button>
    </form>

    <?php
    /**
     * Auteur: Thierry Chatoorang
     * Functie:  huiswerk Hoofdstuk 7 - Opdracht 4
     * Datum: 09-01-2025
     */

    // Controleren of het formulier is ingediend
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Waarden ophalen uit het formulier
        $bedrag = floatval($_POST['bedrag']); // Geldbedrag dat de gebruiker invoert
        $korting = floatval($_POST['korting']); // Kortingspercentage dat de gebruiker invoert

        // Berekening van de korting
        $kortingBedrag = $bedrag * ($korting / 100); // Bedrag van de korting
        $bedragInclusiefKorting = $bedrag - $kortingBedrag; // Eindbedrag na korting

        // Resultaat weergeven, geformatteerd met number_format()
        echo "<h2>Resultaat:</h2>";
        echo "Origineel Bedrag: €" . number_format($bedrag, 2, ',', '.') . "<br>";
        echo "Kortingsbedrag: €" . number_format($kortingBedrag, 2, ',', '.') . "<br>";
        echo "Bedrag na Korting: €" . number_format($bedragInclusiefKorting, 2, ',', '.') . "<br>";
    }
    ?>
</body>
</html>
