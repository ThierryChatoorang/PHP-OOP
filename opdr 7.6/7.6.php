

<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Gemiddelde Berekenen</title>
</head>
<body>
    <form method="post">
        Cijfer: <input type="text" name="cijfer"> 
        <button type="submit">Toevoegen</button> 
    </form>
    <p>Aantal ingevoerde cijfers: <?= $aantal ?></p> 
    <p>Gemiddelde: <?= $gemiddelde ?></p> 

<?php
// Auteur: Thierry Chatoorang
// Datum: 16 januari 2025
//functie : huiswerk hoofdstuk 7 vervolg
session_start(); 

if (!isset($_SESSION['cijfers'])) {
    $_SESSION['cijfers'] = []; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cijfer = floatval($_POST['cijfer']); 
    if ($cijfer >= 1.0 && $cijfer <= 10.0) {
        $_SESSION['cijfers'][] = $cijfer; 
    }
}

$aantal = count($_SESSION['cijfers']); 
$gemiddelde = $aantal > 0 ? round(array_sum($_SESSION['cijfers']) / $aantal, 1) : 0; 
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Gemiddelde Berekenen</title>
</head>
<body>
    <form method="post">
        Cijfer: <input type="text" name="cijfer"> 
        <button type="submit">Toevoegen</button> 
    </form>
    <p>Aantal ingevoerde cijfers: <?= $aantal ?></p> 
    <p>Gemiddelde: <?= $gemiddelde ?></p> 
</body>
</html>
