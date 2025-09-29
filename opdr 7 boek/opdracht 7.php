<?php
// auteur : Thierry Chatoorang 
// functie opdracht van boek 
//Opdracht 7

$spaargeld = 1050; // hier kan je een andere bedrag zette 
$iphonePrijs = 1000; 


$verschil = $iphonePrijs - $spaargeld;


if ($verschil > 250) {
    
    echo "Je komt €" . $verschil . " tekort om de iPhone te kopen. Je kunt beter een baantje zoeken!";
} elseif ($verschil > 0 && $verschil < 250) {
    
    echo "Het lukt bijna! Maar je komt nog steeds €" . $verschil . " tekort om de iPhone te kopen.";
} else {
    
    $over = abs($verschil);
    echo "Gefeliciteerd! Je hebt genoeg spaargeld om de iPhone te kopen.";
    echo " Je houdt €" . $over . " over om bijvoorbeeld een hoesje te kopen.";
}


echo "<br>Je spaargeld: €$spaargeld";
echo "<br>Prijs van de iPhone: €$iphonePrijs";
?>
