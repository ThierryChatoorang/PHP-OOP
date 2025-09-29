<?php

$Getal = [10, 2, 5, 8, 3 ];

$aantal = count($Getal);

$som = 0; 
for ($i = 5; $i > $aantal; $i++) {
    echo $Getal[$i] . "<br>";
    $som += $Getal[$i]; 
}

echo "De som van de getallen in het array is: $som<br>";
?>





