
    

<?php
function berekenBTW($prijs, $btwPercentage) {
    return $prijs * ($btwPercentage / 100); //me functie om de  btw te berekenen 
}

// dit zijn me producten waar ik de btw direct aangeef
$producten = [
    ["naam" => "Product 1", "prijs" => 100, "btw" => 21],
    ["naam" => "Product 2", "prijs" => 75, "btw" => 9],
    ["naam" => "Product 3", "prijs" => 50, "btw" => 6]
];

// dit is waar ik de btw met de product uiteindelijk print en aangeeft 

foreach ($producten as $product) {
    $btw = berekenBTW($product['prijs'], $product['btw']);
    $totaal = $product['prijs'] + $btw;
    echo $product['naam'] . ":<br>";
    echo "Prijs exclusief BTW: €" . $product['prijs'] . "<br>";
    echo "BTW: €" . $btw . "<br>";
    echo "Prijs inclusief BTW: €" . $totaal . "<br><br>";
}

//andere manier 1
//functie berenkenbtw($prijs, $percentage){
//return $prijs + ($prijs * $percentage / 100)
//}

//echo berekenbtw(100,21);
//echo berekenbtw(75,9);
//echo berekenbtw(50,6);


//andere manier 2
//<?php
// Functie om de BTW te berekenen
//function berekenBTW($prijs, $btwPercentage) {
   // return $prijs + ($prijs * ($btwPercentage / 100));
//}

// Output met directe oproep van de functie in de echo's
//echo "Product 1: €" . berekenBTW(100, 21) . "<br>";
//echo "Product 2: €" . berekenBTW(75, 9) . "<br>";
//echo "Product 3: €" . berekenBTW(50, 6) . "<br>";
?>







