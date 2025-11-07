<?php

// Stap 1: Abstracte class Product
abstract class Product {
    private string $name;
    private float $purchasePrice;
    private int $btw;
    private string $description;
    
    public function __construct(string $name, float $purchasePrice, int $btw, string $description) {
        $this->name = $name;
        $this->purchasePrice = $purchasePrice;
        $this->btw = $btw;
        $this->description = $description;
    }
    
    // Getters
    public function getName(): string {
        return $this->name;
    }
    
    public function getPurchasePrice(): float {
        return $this->purchasePrice;
    }
    
    public function getBtw(): int {
        return $this->btw;
    }
    
    public function getDescription(): string {
        return $this->description;
    }
    
    // Bereken verkoopprijs (inkoopprijs + 30% winst + BTW)
    public function getSalePrice(): float {
        $priceWithProfit = $this->purchasePrice * 1.30;
        $priceWithBtw = $priceWithProfit * (1 + ($this->btw / 100));
        return round($priceWithBtw, 2);
    }
    
    // Abstracte methode voor product informatie
    abstract public function getProductInfo(): string;
    
    // Abstracte methode voor categorie naam
    abstract public function getCategory(): string;
}

// Stap 2: Child class Music
class Music extends Product {
    private string $artist;
    private array $tracks;
    
    public function __construct(string $name, float $purchasePrice, int $btw, string $description, string $artist, array $tracks) {
        parent::__construct($name, $purchasePrice, $btw, $description);
        $this->artist = $artist;
        $this->tracks = $tracks;
    }
    
    public function getArtist(): string {
        return $this->artist;
    }
    
    public function getTracks(): array {
        return $this->tracks;
    }
    
    public function getCategory(): string {
        return "Music";
    }
    
    public function getProductInfo(): string {
        $info = "<strong>Artiest:</strong> " . $this->artist . "<br>";
        $info .= "<strong>" . $this->getDescription() . "</strong><br>";
        $info .= "<ul>";
        foreach ($this->tracks as $index => $track) {
            $info .= "<li>number " . ($index + 1) . ": " . $track . "</li>";
        }
        $info .= "</ul>";
        return $info;
    }
}

// Stap 2: Child class Movie
class Movie extends Product {
    private string $quality;
    
    public function __construct(string $name, float $purchasePrice, int $btw, string $description, string $quality) {
        parent::__construct($name, $purchasePrice, $btw, $description);
        $this->quality = $quality;
    }
    
    public function getQuality(): string {
        return $this->quality;
    }
    
    public function getCategory(): string {
        return "Movie";
    }
    
    public function getProductInfo(): string {
        return "<ul><li>" . $this->quality . "</li></ul>";
    }
}

// Stap 2: Child class Game
class Game extends Product {
    private string $genre;
    private array $minRequirements;
    
    public function __construct(string $name, float $purchasePrice, int $btw, string $description, string $genre, array $minRequirements) {
        parent::__construct($name, $purchasePrice, $btw, $description);
        $this->genre = $genre;
        $this->minRequirements = $minRequirements;
    }
    
    public function getGenre(): string {
        return $this->genre;
    }
    
    public function getMinRequirements(): array {
        return $this->minRequirements;
    }
    
    public function getCategory(): string {
        return "Game";
    }
    
    public function getProductInfo(): string {
        $info = "<strong>" . $this->genre . "</strong><br>";
        $info .= "<strong>" . $this->getDescription() . "</strong><br>";
        $info .= "<ul>";
        foreach ($this->minRequirements as $requirement) {
            $info .= "<li>" . $requirement . "</li>";
        }
        $info .= "</ul>";
        return $info;
    }
}

// Stap 3: Class ProductList
class ProductList {
    private array $products = [];
    
    public function addProduct(Product $product): void {
        $this->products[] = $product;
    }
    
    public function getProducts(): array {
        return $this->products;
    }
    
    public function displayTable(): void {
        echo '<table border="1" cellpadding="10" cellspacing="0">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Category</th>';
        echo '<th>Naam product</th>';
        echo '<th>Verkoopprijs</th>';
        echo '<th>Info</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        foreach ($this->products as $product) {
            echo '<tr>';
            echo '<td>' . $product->getCategory() . '</td>';
            echo '<td>' . $product->getName() . '</td>';
            echo '<td>€ ' . number_format($product->getSalePrice(), 2, '.', ' ') . '</td>';
            echo '<td>' . $product->getProductInfo() . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
    }
}

// Voorbeeld gebruik:
$productList = new ProductList();

// Music producten toevoegen
$music1 = new Music(
    "Test1",
    5.00,
    21,
    "Extra info",
    "Artiest 1",
    ["Song A", "Song B"]
);
$productList->addProduct($music1);

$music2 = new Music(
    "Test2",
    10.00,
    21,
    "Extra info",
    "Artiest 2",
    ["Track 1", "Track 2", "Track 3"]
);
$productList->addProduct($music2);

// Movie producten toevoegen
$movie1 = new Movie(
    "Starwars 1",
    10.00,
    21,
    "Een epische film",
    "DVD"
);
$productList->addProduct($movie1);

$movie2 = new Movie(
    "Starwars 2",
    15.00,
    21,
    "Het vervolg",
    "Blueray"
);
$productList->addProduct($movie2);

// Game producten toevoegen
$game1 = new Game(
    "Call of Duty 1",
    50.00,
    21,
    "Extra info",
    "FPS",
    ["8 gb geheugen", "970 GTX"]
);
$productList->addProduct($game1);

$game2 = new Game(
    "Call of Duty 2",
    80.00,
    21,
    "Extra info",
    "FPS",
    ["16gb geheugen", "2070 RTX"]
);
$productList->addProduct($game2);

// Tabel weergeven
$productList->displayTable();

?>