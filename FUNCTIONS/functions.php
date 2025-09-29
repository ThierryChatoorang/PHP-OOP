<?php
 
function CrudBieren(){
    // Menu-item  insert
    $txt = " <h1> Crud BIER</h1>
    <nav>
        <a href= 'http://localhost/FUNCTIONS/insert.php'> Toevoegen nieuw biertje</a>
    </nav>";
    echo $txt;
    $result = GetData("bier");
 
   
 
    PrintCrudBier($result);
}
 
// Haal alle bier record uit de tabel

 
function GetData($tabel){
    // Connect database
    $conn = ConnectDb();
 
    $query = $conn->prepare("SELECT * FROM $tabel");
    $query->execute();
     $result = $query->fetchAll();
   
    // var_dump($result);
    return $result;
}
function InsertBier($post){
    //echo "dit is de functie InsertBier<br>";
    //var_dump($post);
 
    try {
        $conn = ConnectDb();
 
       
        $query = $conn->prepare("
        INSERT INTO bier (naam, soort, stijl, alcohol, brouwcode)
        VALUES (:naam, :soort, :stijl, :alcohol, :brouwcode)");
 
 
        //Oplossing 2
        $query->execute([
            ':naam'=>$post['naam'],
            ':soort'=>$post['soort'],
            ':stijl'=>$post['stijl'],
            ':alcohol'=>$post['alcohol'],
            ':brouwcode'=>$post['brouwcode']

        ]
        );
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function UpdateBier($row)
{
    try {
        // Connect database
        $conn = ConnectDb();

        // Update data uit de opgegeven table methode prepare
        $sql = "UPDATE bier
                SET
                naam = '{$row['naam']}',
                soort = '{$row['soort']}',
                stijl = '{$row['stijl']}',
                alcohol = '{$row['alcohol']}',
                brouwcode = '{$row['brouwcode']}'
                WHERE biercode = '{$row['biercode']}'";

        $query = $conn->prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}
// selecteer de rij van de opgeven biercode uit de table bier
function GetBier($biercode){
    // Connect database
    $conn = ConnectDb();
 
    // Select data uit de opgegeven table methode prepare
 
    $query = $conn->prepare("SELECT * FROM bier WHERE biercode = :biercode");
    $query->execute([':biercode'=>$biercode]);
    $result = $query->fetch();
 
    return $result;
 
 }
function DeleteBier($biercode){
    echo "Delete row<br>";
 
    try {
        $conn = ConnectDb();
 
       
        $query = $conn->prepare("
         DELETE FROM bier WHERE bier.biercode = '$biercode'");
 
 
        //Uitvoer prepare
        return $query->execute();
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
    $dbname= "bieren";
   
    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //echo "Connected successfully";
 
    return $conn;
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
 
}
 
function PrintCrudBier($result) {
    $table = "<table border = 1px>";
 
    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th bgcolor=gray>" . $header . "</th>";  
    }
   
 
    // print rij
    foreach ($result as $row) {
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
 
        $table .= "<td>
             <form method='post' action='update_bier.php?biercode=$row[biercode]' >      
                    <button name='wzg'>Wijzigen</button>    
            </form>
         </td>";


        $table .= "<td>
        <a href='delete_bier.php?biercode=$row[biercode]'>Delete</a>
        </td>";
 
        $table .= "</tr>";
           
    }
   
 
    $table .= "</table>";    
    echo $table;
}
 
?>




