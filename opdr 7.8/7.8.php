<?php
// Auteur: Thierry Chatoorang
// Datum: 16 januari 2025
// functie : vervolg hoofdstuk 7 opdrachten 
session_start();

if (!isset($_SESSION['fruitsoorten'])) {
    $_SESSION['fruitsoorten'] = [];
}

if (isset($_POST['toevoegen'])) {
    $fruitsoort = trim($_POST['fruitsoort']);
    if (!empty($fruitsoort)) {
        $_SESSION['fruitsoorten'][] = $fruitsoort;
    }
}

if (isset($_POST['sorteren'])) {
    sort($_SESSION['fruitsoorten']);
}

if (isset($_POST['schudden'])) {
    shuffle($_SESSION['fruitsoorten']);
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Fruitsoorten</title>
</head>
<body>
    <form method="post">
        Fruitsoort: <input type="text" name="fruitsoort">
        <button type="submit" name="toevoegen">Toevoegen</button>
        <button type="submit" name="sorteren">Sorteren</button>
        <button type="submit" name="schudden">Schudden</button>
    </form>
    <p>Inhoud van de array:</p>
    <ul>
        <?php foreach ($_SESSION['fruitsoorten'] as $fruit) : ?>
            <li><?= htmlspecialchars($fruit) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
