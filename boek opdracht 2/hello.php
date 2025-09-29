


<?php
//auteur Thierry Chatoorang
// functie opdracht 2 boek
// 05/12/2024

function bepaalDagdeelMetMatch() {
    $uur = date("H");

    return match (true) {
        $uur >= 6 && $uur < 12 => "Het is ochtend.",
        $uur >= 12 && $uur < 18 => "Het is middag.",
        $uur >= 18 && $uur < 24 => "Het is avond.",
        default => "Het is nacht."
    };
}

echo bepaalDagdeelMetMatch();
?>
