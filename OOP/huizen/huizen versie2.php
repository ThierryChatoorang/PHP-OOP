<?php 
//CHATGPT VERSIE 
// Class Huis
class Huis {
    public $naam;
    public $aantalVerdiepingen;
    public $aantalKamers;
    public $breedte;
    public $hoogte;
    public $diepte;
    private $prijsPerM3;

    // constructor
    public function __construct($naam, $aantalVerdiepingen, $aantalKamers, $breedte, $hoogte, $diepte) {
        echo "Nieuw huis aangemaakt<br>";
        $this->naam = $naam;
        $this->aantalVerdiepingen = $aantalVerdiepingen;
        $this->aantalKamers = $aantalKamers;
        $this->breedte = $breedte;
        $this->hoogte = $hoogte;
        $this->diepte = $diepte;
        $this->prijsPerM3 = 1500; // standaard prijs
    }

    // bereken volume
    public function berekenVolume() {
        return $this->breedte * $this->hoogte * $this->diepte;
    }

    // bereken prijs
    public function berekenPrijs() {
        return $this->berekenVolume() * $this->prijsPerM3;
    }

    // toon alles in 1 keer
    public function toonDetails() {
        echo "Dit huis is in de stad " . $this->naam . "<br>";
        echo "Aantal verdiepingen: " . $this->aantalVerdiepingen . "<br>";
        echo "Aantal kamers: " . $this->aantalKamers . "<br>";
        echo "Het volume is " . $this->berekenVolume() . " m³<br>";
        echo "De prijs van het huis is: " . $this->berekenPrijs() . "<br><br>";
    }
}

// Main
$huis1 = new Huis("Rotterdam", 2, 4, 5, 5, 4);
$huis1->toonDetails();

$huis2 = new Huis("Amsterdam", 3, 6, 5, 5, 6);
$huis2->toonDetails();

$huis3 = new Huis("Utrecht", 2, 3, 5, 5, 3);
$huis3->toonDetails();

$huis4 = new Huis("Den Haag", 4, 8, 10, 6, 5);
$huis4->toonDetails();
?>
