

<?php
//auteur Thierry Chatoorang
// functie opdracht 3 boek
// 05/12/2024

function berekenUitkomst($getal1, $getal2) {
    $grootste = ($getal1 > $getal2) ? $getal1 : $getal2;
    return ($grootste * 2) + (($getal1 + $getal2) - $grootste);
}

echo "Uitkomst: " . berekenUitkomst(10, 15);
?>



