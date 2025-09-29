<?php
require 'db.connect.php';

for ($i = 0; $i < 100; $i++) {
    $land = "Land" . rand(1, 5);
    $ip = "192.168.1." . rand(2, 254);
    $provider = "Provider" . rand(1, 3);
    $browser = "Browser " . rand(1, 3);
    $datum_tijd = date('Y-m-d H:i:s', strtotime('-' . rand(0, 90) . ' days'));
    $referer = "http://site" . rand(1, 3) . ".com";

    $conn->query("INSERT INTO bezoekers (land, ip_adres, provider, browser, datum_tijd, referer)
                  VALUES ('$land', '$ip', '$provider', '$browser', '$datum_tijd', '$referer')");
}

echo "100 testrecords toegevoegd.";
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>  
    <title>Testdata toegevoegd</title>