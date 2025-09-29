<?php
require 'db.connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $land = $_POST['land'];
    $ipadres = $_POST['ipadres'];
    $provider = $_POST['provider'];
    $browser = $_POST['browser'];
    $datum_tijd = $_POST['datum_tijd'];
    $referer = $_POST['referer'];

    $sql = "INSERT INTO bezoekers (land, ip_adres, provider, browser, datum_tijd, referer)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $land, $ipadres, $provider, $browser, $datum_tijd, $referer);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ Bezoeker succesvol toegevoegd.</p>";
    } else {
        echo "<p style='color:red;'>❌ Fout bij toevoegen: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bezoeker Toevoegen</title>
</head>
<body>
    <h2>Manueel Bezoeker Toevoegen</h2>
    <form method="post">
        Land: <input type="text" name="land" required><br><br>
        IP-adres: <input type="text" name="ipadres" value="192.168.1.100" required><br><br>
        Provider: <input type="text" name="provider" required><br><br>
        Browser: <input type="text" name="browser" required><br><br>
        Datum/Tijd: <input type="datetime-local" name="datum_tijd" required><br><br>
        Referer: <input type="text" name="referer"><br><br>
        <input type="submit" value="Bezoeker Toevoegen">
    </form>

    <p><a href="beheerder.php">⬅ Terug naar Statistieken</a></p>
</body>
</html>
