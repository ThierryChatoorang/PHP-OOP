<?php
    // Auteur: Thierry Chatoorang
    // Functie: Huiswerk
    // Hoofdstuk 7 - Opdracht 3
    // Datum: Datum: 09-01-2025
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['color'])) {
    session_start();
    $_SESSION['bgcolor'] = $_POST['color'];
} else {
    session_start();
    // Zet een standaardkleur als er geen kleur is gekozen
    if (!isset($_SESSION['bgcolor'])) {
        $_SESSION['bgcolor'] = 'white';
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verander achtergrondkleur</title>
    <style>
        body {
            background-color: <?php echo $_SESSION['bgcolor']; ?>;
        }
    </style>
</head>
<body>

<h1>Verander de achtergrondkleur</h1>
<form method="POST">
    <label>
        <input type="radio" name="color" value="red" <?php if ($_SESSION['bgcolor'] == 'red') echo 'checked'; ?>> Rood
    </label><br>
    <label>
        <input type="radio" name="color" value="green" <?php if ($_SESSION['bgcolor'] == 'green') echo 'checked'; ?>> Groen
    </label><br>
    <label>
        <input type="radio" name="color" value="blue" <?php if ($_SESSION['bgcolor'] == 'blue') echo 'checked'; ?>> Blauw
    </label><br>
    <label>
        <input type="radio" name="color" value="yellow" <?php if ($_SESSION['bgcolor'] == 'yellow') echo 'checked'; ?>> Geel
    </label><br>
    <button type="submit">Verzend</button>
</form>

</body>
</html>

