<?php
    // functie: update bier
    // auteur: Student naam

    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(updateRecord($_POST) == true){
            echo "<script>alert('Bier is gewijzigd')</script>";
            echo "<script> location.replace('index.php'); </script>";
        } else {
            echo '<script>alert("Bier is NIET gewijzigd")</script>';
        }
    }

    // Test of id is meegegeven in de URL
    if(isset($_GET['id'])){  
        // Haal alle info van de betreffende id $_GET['id']
        $id = $_GET['id'];
        $row = getRecord($id);
        
        // Haal alle brouwers op voor dropdown
        $brouwers = getBrouwerijen();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Bier</title>
</head>
<body>
  <h2>Wijzig Bier</h2>
  <form method="post">
    
    <input type="hidden" id="id" name="id" required value="<?php echo $row['biercode']; ?>"><br>
    
    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required value="<?php echo $row['naam']; ?>"><br>

    <label for="soort">Soort:</label>
    <input type="text" id="soort" name="soort" required value="<?php echo $row['soort']; ?>"><br>

    <label for="stijl">Stijl:</label>
    <input type="text" id="stijl" name="stijl" required value="<?php echo $row['stijl']; ?>"><br>

    <label for="alcohol">Alcohol:</label>
    <input type="number" id="alcohol" name="alcohol" step="0.1" required value="<?php echo $row['alcohol']; ?>"><br>

    <label for="brouwcode">Choose a brouwcode:</label>
    <select id="brouwcode" name="brouwcode">
        <?php foreach($brouwers as $brouwer): ?>
            <option value="<?= $brouwer['brouwcode'] ?>" 
                <?= ($row['brouwcode'] == $brouwer['brouwcode']) ? 'selected' : '' ?>>
                <?= $brouwer['naam'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='index.php'>Home</a>
</body>
</html>

<?php
    } else {
        echo "Geen id opgegeven<br>";
    }
?>