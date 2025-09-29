<?php
include "functions.php";
//auteur : Thierry Chatoorang

// Test of er op de insert-knop is gedrukt 
if(isset($_POST['btn_ins'])){
    // test for valid form values
    $merk = $_POST['merk'] != "" ? $_POST['merk'] : null;
    $type = $_POST['type'] != "" ? $_POST['type'] : null;
    $prijs = $_POST['prijs'] != "" ? $_POST['prijs'] : null;

    if($merk !== null && $type !== null && $prijs !== null) {
        InsertFiets($_POST);
        echo '<script>alert("Fiets toegevoegd!")</script>';
        echo "<script>window.location = 'fiets.php'</script>";
    } else {
        echo '<script>alert("Alle velden zijn verplicht!")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Fiets Toevoegen</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Nieuwe Fiets Toevoegen</h1>
    <div class="form-container">
        <form method="post">
            <div>
                <label for="merk">Merk:</label>
                <input type="text" name="merk" id="merk" required>
            </div>
            
            <div>
                <label for="type">Type:</label>
                <input type="text" name="type" id="type" required>
            </div>
            
            <div>
                <label for="prijs">Prijs:</label>
                <input type="number" name="prijs" id="prijs" step="0.01" required>
            </div>
            
            <button type="submit" name="btn_ins">Toevoegen</button>
        </form>
    </div>
    <a href="fiets.php" class="back-link">Terug naar overzicht</a>
</body>
</html>