<?php
require 'db.connect.php';

$ipadres = gethostbyname(gethostname());
$land = "Nederland"; // of willekeurig, bv. $_GET['land'] bij test
$provider = "Ziggo"; // ook fictief
$browser = $_SERVER['HTTP_USER_AGENT'];
$datum_tijd = date('Y-m-d H:i:s');
$referer = $_SERVER['HTTP_REFERER'] ?? "Direct";

$sql = "INSERT INTO bezoekers (land, ip_adres, provider, browser, datum_tijd, referer)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $land, $ipadres, $provider, $browser, $datum_tijd, $referer);
$stmt->execute();

$stmt->close();
$conn->close();
?>

