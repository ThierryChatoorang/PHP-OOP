<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $docent_id = $_POST['docent_id'];
    $datum = $_POST['datum'];
    $reden = $_POST['reden'];

    $stmt = $conn->prepare("INSERT INTO ziekmeldingen (docent_id, datum, reden) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $docent_id, $datum, $reden);
    $stmt->execute();

    echo "Ziekmelding succesvol toegevoegd.";
}
?>
