<?php
// auteur: Thierry Chatoorang
// functie: algemene functies voor brouwer CRUD

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
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function crudMain(){
    // Menu-item   insert
    $txt = "
    <h1>Crud Brouwers</h1>
    <nav>
		<a href='insert.php'>Toevoegen nieuwe brouwer</a>
    </nav><br>";
    echo $txt;

    // Haal alle brouwers record uit de tabel 
    $result = getData(CRUD_TABLE);

    //print table
    printCrudTabel($result);
}

// selecteer de data uit de opgeven table
function getData($table){
    $conn = connectDb();

    $sql = "SELECT * FROM $table";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

// selecteer de rij van de opgeven id uit de table brouwer
function getRecord($id){
    $conn = connectDb();

    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE brouwcode = :id";
    $query = $conn->prepare($sql);
    $query->execute([':id'=>$id]);
    $result = $query->fetch();

    return $result;
}

// Function 'printCrudTabel' print een HTML-table met data uit $result 
function printCrudTabel($result){
    $table = "<table>";

    // Print header table
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }
    // Voeg actie kopregel toe
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</tr>";

    // print elke rij
    foreach ($result as $row) {
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }
        
        // Wijzig knopje
        $table .= "<td>
            <form method='post' action='update.php?id=$row[brouwcode]' >       
                <button>update</button>	 
            </form></td>";

        // Delete knopje
        $table .= "<td>
            <form method='post' action='delete.php?id=$row[brouwcode]' >       
                <button>Verwijder</button>	 
            </form></td>";

        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}

function updateRecord($row){
    $conn = connectDb();

    $sql = "UPDATE " . CRUD_TABLE . "
    SET 
        naam = :naam, 
        landcode = :landcode
    WHERE brouwcode = :id
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam'=>$row['naam'],
        ':landcode'=>$row['landcode'],
        ':id'=>$row['brouwcode']
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function insertRecord($post){
    $conn = connectDb();

    $sql = "
        INSERT INTO " . CRUD_TABLE . " (naam, landcode)
        VALUES (:naam, :landcode) 
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam'=>$_POST['naam'],
        ':landcode'=>$_POST['landcode']
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}

function deleteRecord($id){
    $conn = connectDb();
    
    // Check if brouwer is used in bier table
    $checkSql = "SELECT COUNT(*) as count FROM bier WHERE brouwcode = :id";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->execute([':id' => $id]);
    $result = $checkStmt->fetch();
    
    if ($result['count'] > 0) {
        throw new Exception('Deze brouwer is in gebruik en kan niet worden verwijderd.');
    }
    
    $sql = "DELETE FROM " . CRUD_TABLE . " WHERE brouwcode = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}
?>

