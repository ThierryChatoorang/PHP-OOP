<?php
// auteur : Thierry Chatoorang 
// functie opdracht van boek 
//Opdracht 8



// Variabele met je eigen leeftijd
$leeftijd = 18; // je moet je eigen leeftijd zetten


$stempasontvangen = false; 


if ($leeftijd >= 16) {
    echo "Je mag praktijkexamen voor je scooterrijbewijs doen.";
} else {
    echo "Je mag nog geen praktijkexamen voor je scooterrijbewijs doen.";
}


if ($leeftijd >= 18) {
    if ($stempasontvangen) {
        echo "Je mag stemmen.";
    } else {
        echo "Je mag niet stemmen, want je hebt geen stempas!";
    }
} else {
    echo "Je mag nog niet stemmen.";
}
?>
