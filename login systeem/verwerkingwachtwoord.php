<?php
// wachtwoord_wijzigen_verwerken.php

include 'config.php';
session_start();

// Controleert of beide velden zijn ingevuld
if (!empty($_POST['username']) && !empty($_POST['newPassword'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

    try {
        // Verbind met de database
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Controleer of de gebruiker bestaat
        $checkUser = $db->prepare("SELECT * FROM gebruikers WHERE username = :username");
        $checkUser->bindParam(':username', $username);
        $checkUser->execute();

        if ($checkUser->rowCount() > 0) {
            // Gebruiker bestaat, update wachtwoord
            $query = $db->prepare("UPDATE gebruikers SET password = :newPassword WHERE username = :username");
            $query->bindParam(':newPassword', $newPassword);
            $query->bindParam(':username', $username);

            if ($query->execute()) {
                echo "Het wachtwoord is succesvol gewijzigd.";
            } else {
                echo "Er is een fout opgetreden bij het wijzigen van het wachtwoord.";
            }
        } else {
            echo "Deze gebruiker bestaat niet.";
        }
    } catch (PDOException $e) {
        die("Databasefout: " . $e->getMessage());//er fout met de database
    }
} else {
    echo "Vul alle velden in.";
}
?>
