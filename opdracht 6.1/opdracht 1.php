<?php
// auteur : thierry chatoorang 
// functie : huiswerk opdracht 1 
// datum 19/12/2024
session_start();
if (!isset($_SESSION['aantal_bezoeken'])) {
    $_SESSION['aantal_bezoeken'] = 1; 
} else {
    $_SESSION['aantal_bezoeken']++; 
}
echo "Deze pagina is " . $_SESSION['aantal_bezoeken'] . " keer bezocht.";
?>
