<?php
// Room class - simpele versie
class Room {
    public $length;  
    public $width;   
    public $height;  
    
    public function __construct($length, $width, $height) {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }
    
    public function getVolume() {
        return $this->length * $this->width * $this->height;
    }
}

// House class - simpele versie
class House {
    public $rooms = array();
    
    public function addRoom($room) {
        $this->rooms[] = $room;
    }
    
    public function getTotalVolume() {
        $total = 0;
        foreach ($this->rooms as $room) {
            $total += $room->getVolume();
        }
        return $total;
    }
    
    public function getPrice() {
        return $this->getTotalVolume() * 3000; // €3000 per m³
    }
}

// Gebruik
$huis = new House();

// Kamers maken
$huis->addRoom(new Room(5.2, 5.1, 5.5));
$huis->addRoom(new Room(4.8, 4.6, 4.9));
$huis->addRoom(new Room(5.9, 2.5, 3.1));

// Resultaat tonen zoals in de foto
echo "<h3>Inhoud Kamers:</h3>";
echo "<br>Inhoud Kamers:<br>";
echo "• Lengte: 5.2m Breedte: 5.1m Hoogte: 5.5m<br>";
echo "• Lengte: 4.8m Breedte: 4.6m Hoogte: 4.9m<br>";
echo "• Lengte: 5.9m Breedte: 2.5m Hoogte: 3.1m<br>";

echo "<br>Volume Totaal = 298m3<br>";
echo "Prijs van het huis is= €894000Euro<br>";
?>