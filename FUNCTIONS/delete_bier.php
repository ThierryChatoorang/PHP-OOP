<?php
// auteur: Thierry Chatoorang
// functie: verwijder een bier op basis van de biercode
include 'functions.php';
 
// Haal bier uit de database
if(isset($_GET['biercode'])){
    DeleteBier($_GET['biercode']);
 
    echo '<script>alert("Biercode: ' . $_GET['biercode'] . ' is verwijderd")</script>';
    echo "<script> location.replace('crudbieren.php'); </script>";
}
?>