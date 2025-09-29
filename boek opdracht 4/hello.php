


<?php
//auteur Thierry Chatoorang
// functie opdracht 4 boekb  
// 05/12/2024

function berekenNieuwePrijs($oudePrijs) {
    if ($oudePrijs > 150) {
        $nieuwePrijs = $oudePrijs * 1.19; // 19% verhoging
    } elseif ($oudePrijs < 55) {
        $nieuwePrijs = $oudePrijs * 1.11; // 11% verhoging
    } else {
        $nieuwePrijs = $oudePrijs * 1.16; // 16% verhoging
    }
    return number_format($nieuwePrijs, 2, ',', '.');
}

$oudePrijs = 100;
echo "Oude prijs: € $oudePrijs. Na verhoging is de prijs: € " . berekenNieuwePrijs($oudePrijs);
?>
