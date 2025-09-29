<?php
// Auteur: Thierry Chatoorang
// Datum: 11-12-2024
//opdracht 10 van boek 
$getal = 12; 
$som = 0; 

echo "Optelling als volgt: <br>";
for ($i = 1; $i <= $getal; $i++) {
    $som += $i; 
    echo $i;
    if ($i < $getal) {
        echo " + "; 
    }
}
echo " = $som <br>";

echo "Waarde van variabele \$getal is: $getal";
?>
