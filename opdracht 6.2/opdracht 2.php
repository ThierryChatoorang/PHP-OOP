<?php
// auteur : thierry chatoorang 
// functie : huiswerk opdracht 2
// datum 19/12/2024
session_start();
if (!isset($_SESSION['aantal_bezoeken'])) {
    $_SESSION['aantal_bezoeken'] = 1; 
} else {
    $_SESSION['aantal_bezoeken']++; 
}

if ($_SESSION['aantal_bezoeken'] > 10) {
    echo "Je hebt deze pagina al meer dan 10 keer bezocht.";
    session_destroy(); 
} else {
    echo "Deze pagina is " . $_SESSION['aantal_bezoeken'] . " keer bezocht.";
}
?>
