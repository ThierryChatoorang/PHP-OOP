<?php 
//properties 
class Huis {
    // eigenschappen van een huis
    public $naam;
    public $aantalVerdiepingen;
    public $aantalKamers;
    public $breedte;
    public $hoogte;
    public $diepte;
    private $prijsPerM3;

    // constructor (wordt uitgevoerd bij het maken van een nieuw huis) wordt uitgevoerd bij het maken van een nieuw huis 
    public function __construct($naam = null, $aantalVerdiepingen = null, $aantalKamers = null, $breedte = null, $hoogte = null, $diepte = null) {
        echo "Nieuw huis aangemaakt<br>";
        $this->naam = $naam;
        $this->aantalVerdiepingen = $aantalVerdiepingen;
        $this->aantalKamers = $aantalKamers;
        $this->breedte = $breedte;
        $this->hoogte = $hoogte;
        $this->diepte = $diepte;
        $this->setPrijsPerM3(1500); // standaard prijs per m3
    }

    // naam printen
    public function printNaam() {
        echo "Dit huis is in de stad " . $this->naam . "<br>";
    }

    // verdiepingen printen
    public function printVerdiepingen() {
        echo "Aantal verdiepingen: " . $this->aantalVerdiepingen . "<br>";
    }

    // kamers printen
    public function printKamers() {
        echo "Aantal kamers: " . $this->aantalKamers . "<br>";
    }

    // volume berekenen //dit valideert de construct functie met een return zorgt dat de waarden kloppen, al is het een comma getal dan krijg ik geen error    
    public function berekenVolume() {
        return $this->breedte * $this->hoogte * $this->diepte;
    }

    // prijs berekenen
    public function berekenPrijs() {
        return $this->berekenVolume() * $this->prijsPerM3;
    }

    // volume en prijs tonen
    public function printAfmetingEnPrijs() {
        echo "De afmeting is: " . $this->berekenVolume() . " m³<br>";
        echo "De prijs van het huis is: " . $this->berekenPrijs() . "<br><br>";
    }

    // setter (prijs per m3 instellen)
    public function setPrijsPerM3($prijs) {
        $this->prijsPerM3 = $prijs;
    }

    // getter (prijs per m3 ophalen)
    public function getPrijsPerM3() {
        return $this->prijsPerM3;
    }
}

// Main (huizen aanmaken en tonen)
$huis1 = new Huis("Rotterdam", 2, 4, 5, 5, 4);
$huis1->printNaam();
$huis1->printVerdiepingen();
$huis1->printKamers();
$huis1->printAfmetingEnPrijs();

$huis2 = new Huis("Amsterdam", 3, 6, 5, 5, 6);
$huis2->printNaam();
$huis2->printVerdiepingen();
$huis2->printKamers();
$huis2->printAfmetingEnPrijs();

$huis3 = new Huis("Utrecht", 2, 3, 5, 5, 3);
$huis3->printNaam();
$huis3->printVerdiepingen();
$huis3->printKamers();
$huis3->printAfmetingEnPrijs();

$huis4 = new Huis("Den Haag", 4, 8, 10, 6, 5);
$huis4->printNaam();
$huis4->printVerdiepingen();
$huis4->printKamers();
$huis4->printAfmetingEnPrijs();

