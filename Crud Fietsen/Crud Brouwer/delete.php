<?php
// auteur: Thierry Chatoorang
// functie: verwijder een brouwer op basis van de id
include 'functions.php';

// Haal brouwer uit de database
if(isset($_GET['id'])){
    try {
        // test of verwijderen gelukt is
        if(deleteRecord($_GET['id']) == true){
            echo '<script>alert("Brouwer: ' . $_GET['id'] . ' is verwijderd")</script>';
            echo "<script> location.replace('home.php'); </script>";
        }
    } catch (Exception $e) {
        echo '<script>alert("' . $e->getMessage() . '")</script>';
        echo "<script> location.replace('home.php'); </script>";
    }
}
?>