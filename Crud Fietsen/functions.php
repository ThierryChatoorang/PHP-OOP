<?php
 //auteur : Thierry Chatoorang
function CrudFietsen(){
    // Menu-item insert
    $txt = " <h1>Fietsen Beheer</h1>
    <nav>
        <a href='insert.php'>Toevoegen nieuwe fiets</a>
    </nav>";
    echo $txt;
    $result = GetData("fietsen");
 
    PrintCrudFietsen($result);
}
 
// Haal alle fiets records uit de tabel
function GetData($tabel){
    // Connect database
    $conn = ConnectDb();
 
    $query = $conn->prepare("SELECT * FROM $tabel");
    $query->execute();
    $result = $query->fetchAll();
   
    return $result;
}

function InsertFiets($post){
    try {
        $conn = ConnectDb();
 
        $query = $conn->prepare("
        INSERT INTO fietsen (merk, type, prijs)
        VALUES (:merk, :type, :prijs)");
 
        $query->execute([
            ':merk'=>$post['merk'],
            ':type'=>$post['type'],
            ':prijs'=>$post['prijs']
        ]);
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function UpdateFiets($row)
{
    try {
        // Connect database
        $conn = ConnectDb();

        // Update data uit de opgegeven table methode prepare
        $sql = "UPDATE fietsen
                SET
                merk = :merk,
                type = :type,
                prijs = :prijs
                WHERE id = :id";

        $query = $conn->prepare($sql);
        $query->execute([
            ':merk' => $row['merk'],
            ':type' => $row['type'],
            ':prijs' => $row['prijs'],
            ':id' => $row['id']
        ]);
    } catch (PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}

// selecteer de rij van de opgeven fiets id uit de table fietsen
function GetFiets($id){
    // Connect database
    $conn = ConnectDb();
 
    // Select data uit de opgegeven table methode prepare
    $query = $conn->prepare("SELECT * FROM fietsen WHERE id = :id");
    $query->execute([':id'=>$id]);
    $result = $query->fetch();
 
    return $result;
}

function DeleteFiets($id){
    try {
        $conn = ConnectDb();
       
        $query = $conn->prepare("DELETE FROM fietsen WHERE id = :id");
 
        //Uitvoer prepare
        return $query->execute([':id'=>$id]);
    }
    catch(PDOException $e) {
        echo("Delete failed: " . $e->getMessage());
        return;
    }
}

function ConnectDb(){
 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname= "fietsenmaker"; 
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
     
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
 
function PrintCrudFietsen($result) {
    $table = "<table>";
 
    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";  
    }
    $table .= "<th>Wijzigen</th>";
    $table .= "<th>Verwijderen</th>";
 
    // print rij
    foreach ($result as $row) {
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
 
        $table .= "<td>
             <form method='post' action='update.php?id=$row[id]' >      
                    <button name='wzg'>Wijzigen</button>    
            </form>
         </td>";

        $table .= "<td>
        <a href='delete.php?id=$row[id]' class='delete'>Delete</a>
        </td>";
 
        $table .= "</tr>";
    }
   
    $table .= "</table>";    
    echo $table;
}
?>