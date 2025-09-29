<?php
include "functions.php";
//auteur : Thierry Chatoorang

// Test of er op de update-knop is gedrukt 
if(isset($_POST['btn_wzg'])) {
    // test for valid form values
    $merk = $_POST['merk'] != "" ? $_POST['merk'] : null;
    $type = $_POST['type'] != "" ? $_POST['type'] : null;
    $prijs = $_POST['prijs'] != "" ? $_POST['prijs'] : null;

    if($merk !== null && $type !== null && $prijs !== null) {
        UpdateFiets($_POST);
        echo '<script>alert("Fiets bijgewerkt!")</script>';
        echo "<script>window.location = 'fiets.php'</script>";
    } else {
        echo '<script>alert("Alle velden zijn verplicht!")</script>';
    }
}

if(isset($_GET['id'])) {
    // Haal de fiets data op met de opgegeven fiets id
    $id = $_GET['id'];
    $row = GetFiets($id);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiets Wijzigen</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Fiets Wijzigen</h1>
    <div class="form-container">
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            
            <div>
                <label for="merk">Merk:</label>
                <input type="text" name="merk" id="merk" value="<?php echo $row['merk']; ?>" required>
            </div>
            
            <div>
                <label for="type">Type:</label>
                <input type="text" name="type" id="type" value="<?php echo $row['type']; ?>" required>
            </div>
            
            <div>
                <label for="prijs">Prijs:</label>
                <input type="number" name="prijs" id="prijs" step="0.01" value="<?php echo $row['prijs']; ?>" required>
            </div>
            
            <button type="submit" name="btn_wzg">Wijzigen</button>
        </form>
    </div>
    <a href="fiets.php" class="back-link">Terug naar overzicht</a>
</body>
</html>