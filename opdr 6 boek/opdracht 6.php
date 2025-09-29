<?php
// auteur : Thierry Chatoorang 
// functie opdracht van boek 
//Opdracht 6
$uur = (int) date("H"); 
$temperatuur = 22;
$luchtvochtigheid = 80;


if ($uur >= 17 || ($temperatuur < 20 && $luchtvochtigheid < 85)) {
    echo "De airco wordt uitgeschakeld.";
} else {
    echo "De airco blijft aan.";
}


echo "<br>Huidig uur: $uur uur";
echo "<br>Temperatuur: $temperatuur °C";
echo "<br>Luchtvochtigheid: $luchtvochtigheid%";
?>