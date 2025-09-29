<?php
// Auteur: Thierry Chatoorang
// Datum: 16 januari 2025
//functie : hoofdstuk 7 vervolg  opdracht

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startkapitaal = floatval($_POST['startkapitaal']);
    $rentepercentage = floatval($_POST['rentepercentage']);
    $opname = floatval($_POST['opname']);

    $jaren = 0;
    while ($startkapitaal > 0 && $jaren < 100) {
        $startkapitaal += $startkapitaal * ($rentepercentage / 100);
        $startkapitaal -= $opname;
        $jaren++;
    }

    if ($jaren >= 100) {
        $resultaat = "U kunt het bedrag uw hele leven lang opnemen.";
    } else {
        $resultaat = "U kunt $jaren jaar lang €$opname opnemen.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Looptijd Berekenen</title>
</head>
<body>
    <form method="post">
        Startkapitaal: <input type="text" name="startkapitaal" value="100000"><br>
        Rentepercentage: <input type="text" name="rentepercentage" value="4"><br>
        Jaarlijkse opname: <input type="text" name="opname" value="5000"><br>
        <button type="submit">Bereken de looptijd</button>
    </form>
    <p><?= isset($resultaat) ? $resultaat : '' ?></p>
</body>
</html>
