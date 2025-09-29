<?php
// auteur: Student naam
// functie: algemene functies tbv hergebruik

include_once "config.php";

function connectDb(){
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //echo "Connected successfully";
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function crudMain(){
    // Menu-item insert
    $txt = "
    <h1>Crud Bieren</h1>
    <nav>
		<a href='insert.php'>Toevoegen nieuw bier</a>
    </nav><br>";
    echo $txt;

    // Haal alle bieren record uit de tabel 
    $result = getData(CRUD_TABLE);

    //print table
    printCrudTabel($result);
}

// selecteer de data uit de opgeven table
function getData($table){
    // Connect database
    $conn = connectDb();

    // Select data uit de opgegeven table methode prepare
    $sql = "SELECT b.*, br.naam as brouwernaam 
            FROM $table b
            LEFT JOIN brouwer br ON b.brouwcode = br.brouwcode";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

// selecteer de rij van de opgeven id uit de table bieren
function getRecord($id){
    // Connect database
    $conn = connectDb();

    // Select data uit de opgegeven table methode prepare
    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE biercode = :id";
    $query = $conn->prepare($sql);
    $query->execute([':id'=>$id]);
    $result = $query->fetch();

    return $result;
}

// Function 'printCrudTabel' print een HTML-table met data uit $result 
// en een wzg- en -verwijder-knop.
function printCrudTabel($result){
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table>";

    // Print header table
    // haal de kolommen uit de eerste rij [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }
    // Voeg actie kopregel toe
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</th>";

    // print elke rij
    foreach ($result as $row) {
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }
        
        // Wijzig knopje
        $table .= "<td>
            <form method='post' action='update.php?id=$row[biercode]' >       
                <button>Wzg</button>	 
            </form></td>";

        // Delete knopje
        $table .= "<td>
            <form method='post' action='delete.php?id=$row[biercode]' >       
                <button>Verwijder</button>	 
            </form></td>";

        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}

// Haal alle brouwerijen op voor dropdown
function getBrouwerijen() {
    // Connect database
    $conn = connectDb();
    
    // Select data uit de brouwerijen table
    $sql = "SELECT brouwcode, naam FROM brouwer ORDER BY naam";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
    
    return $result;
}

function updateRecord($row){
    // Maak database connectie
    $conn = connectDb();

    // Maak een query 
    $sql = "UPDATE " . CRUD_TABLE .
    " SET 
        naam = :naam, 
        soort = :soort, 
        stijl = :stijl,
        alcohol = :alcohol,
        brouwcode = :brouwcode
    WHERE biercode = :id
    ";

    // Prepare query
    $stmt = $conn->prepare($sql);
    // Uitvoeren
    $stmt->execute([
        ':naam'=>$row['naam'],
        ':soort'=>$row['soort'],
        ':stijl'=>$row['stijl'],
        ':alcohol'=>$row['alcohol'],
        ':brouwcode'=>$row['brouwcode'],
        ':id'=>$row['id']
    ]);

    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function insertRecord($post){
    // Maak database connectie
    $conn = connectDb();

    // Maak een query 
    $sql = "
        INSERT INTO " . CRUD_TABLE . " (naam, soort, stijl, alcohol, brouwcode)
        VALUES (:naam, :soort, :stijl, :alcohol, :brouwcode) 
    ";

    // Prepare query
    $stmt = $conn->prepare($sql);
    // Uitvoeren
    $stmt->execute([
        ':naam'=>$_POST['naam'],
        ':soort'=>$_POST['soort'],
        ':stijl'=>$_POST['stijl'],
        ':alcohol'=>$_POST['alcohol'],
        ':brouwcode'=>$_POST['brouwcode']
    ]);
    
    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}

function deleteRecord($id){
    // Connect database
    $conn = connectDb();
    
    // Maak een query 
    $sql = "
    DELETE FROM " . CRUD_TABLE . 
    " WHERE biercode = :id";

    // Prepare query
    $stmt = $conn->prepare($sql);

    // Uitvoeren
    $stmt->execute([
    ':id'=>$_GET['id']
    ]);

    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}
?>