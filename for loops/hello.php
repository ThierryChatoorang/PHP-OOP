<?php
//auteur Thierry Chatoorang
// functie for loops uitleg
// 04/12/2024

//initialisatie 
// for loop bestaat uit drie delen : start , conditie , eind
// wordt gebruikt als je van te voren weet hoe vaak iets herhaald wordt 
for ($x = 5; $x <= 20 ; $x ++) {
  echo "The number is: $x <br>";
}

//while
$price = 10;
while ($price < 100) {
    $price = $price + 25;
    echo "de prijs wordt met 25 verhoogd : $price <br>";
}

    //var iable is 1 bakje 
    //array is 1 bakje met secties erin dus je kan maar dan 1 waarde []

//maken van een array 

$c[0] = 10;
$c[1] = 9;
var_dump($c);

// zo kan je een array maken 
$d = ["piet",7 , "Henry",8, "Sam",6, "Karel",3];
//telt het aantal elementen in een array
$aantal = count($d);



//print met een loop alle studenten waarbij de naam en het cijfer op een aparte regel geprint worden
//piet , 7
//jan , 8 
//enz ...


echo $d[0] . "," . $d[1] . "<br>";
echo $d[2] . "," . $d[3] . "<br>";
echo $d[4] . "," . $d[5] . "<br>";


for ($i = 0 ; $aantal; $i = $i + 2) {
echo $d[$i] .".". $d[$i+1] . "<br>";
}


    




?>