<?php
// functie: nieuw bier toevoegen
// auteur: Thierry Chatoorang

require_once('functions.php');

if(isset($_POST['btn_toevoegen'])){
    if(insertRecord($_POST)){
        echo "<script>alert('Nieuw bier toegevoegd!');</script>";
        echo "<script>location.replace('index.php');</script>";
    } else {
        echo "<script>alert('Toevoegen mislukt!');</script>";
    }
}

// Haal alle brouwerijen op voor dropdown
$brouwers = getBrouwerijen();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Nieuw Bier Toevoegen</title>
</head>
<body>
  <h2>Nieuw Bier Toevoegen</h2>
  <form method="post">
    
    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required><br>

    <label for="soort">Soort:</label>
    <input type="text" id="soort" name="soort" required><br>

    <label for="stijl">Stijl:</label>
    <input type="text" id="stijl" name="stijl" required><br>

    <label for="alcohol">Alcohol:</label>
    <input type="number" id="alcohol" name="alcohol" step="0.1" required><br>

    <label for="brouwcode">Brouwer:</label>
    <select id="brouwcode" name="brouwcode" required>
        <?php foreach($brouwers as $brouwer): ?>
            <option value="<?= $brouwer['brouwcode'] ?>"><?= $brouwer['naam'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" name="btn_toevoegen" value="Toevoegen">
  </form>
  <br><br>
  <a href='index.php'>Home</a>
</body>
</html>
