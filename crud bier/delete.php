<?php
// auteur: Student naam
// functie: verwijder een bier op basis van de id
include 'functions.php';

// Haal bier uit de database
if(isset($_GET['id'])){

    // test of delete gelukt is
    if(deleteRecord($_GET['id']) == true){
        echo '<script>alert("Biercode: ' . $_GET['id'] . ' is verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("Bier is NIET verwijderd")</script>';
    }
}
?>