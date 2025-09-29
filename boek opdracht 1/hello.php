


<?php
//auteur Thierry Chatoorang
// functie opdracht 1 boek
// 05/12/2024

function bepaalDagdeel() {
    $uur = date("H"); // Haal het huidige uur op

    if ($uur >= 6 && $uur < 12) {
        return "Het is ochtend.";
    } elseif ($uur >= 12 && $uur < 18) {
        return "Het is middag.";
    } elseif ($uur >= 18 && $uur < 24) {
        return "Het is avond.";
    } else {
        return "Het is nacht.";
    }
}

echo bepaalDagdeel();
?>
