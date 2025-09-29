<?php
//auteur : thierry Chatoorang 
//datum : 16 januari 2024 
// functie : vervolg hw opdrachten van hoofdstuk 7 
$resultaat = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['tekst'] ?? '';
    $bewerking = $_POST['bewerking'] ?? '';

    
    if ($bewerking == "hoofdletters") {
        $resultaat = strtoupper($input);
    } elseif ($bewerking == "kleine_letters") {
        $resultaat = strtolower($input);
    } elseif ($bewerking == "eerste_letter_zin") {
        $resultaat = ucfirst(strtolower($input));
    } elseif ($bewerking == "eerste_letter_woord") {
        $resultaat = ucwords(strtolower($input));
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tekstbewerking</title>
</head>
<body>
    <form method="post">
        <label>Voer tekst in:</label><br>
        <input type="text" name="tekst" value=""><br><br>

        <label><input type="radio" name="bewerking" value="hoofdletters"> Hoofdletters</label><br>
        <label><input type="radio" name="bewerking" value="kleine_letters"> Kleine letters</label><br>
        <label><input type="radio" name="bewerking" value="eerste_letter_zin"> Eerste letter van de zin</label><br>
        <label><input type="radio" name="bewerking" value="eerste_letter_woord"> Eerste letter van elk woord</label><br><br>

        <button type="submit">Verzenden</button>
    </form>

    <?php if ($resultaat): ?>
        <h3>Resultaat:</h3>
        <p><?php echo $resultaat; ?></p>
    <?php endif; ?>
</body>
</html>
