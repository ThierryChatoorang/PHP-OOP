<?php
include "functions.php";
//auteur : Thierry Chatoorang

if(isset($_GET['id'])) {
    // Haal de fiets data op met de opgegeven fiets id
    $id = $_GET['id'];
    $row = GetFiets($id);
}

// Test of er op de delete-knop is gedrukt 
if(isset($_POST['btn_del'])) {
    DeleteFiets($_POST['id']);
    echo '<script>alert("Fiets verwijderd!")</script>';
    echo "<script>window.location = 'fiets.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiets Verwijderen</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Fiets Verwijderen</h1>
    <div class="form-container">
        <p>Weet u zeker dat u deze fiets wilt verwijderen?</p>
        <table>
            <tr>
                <th>ID</th>
                <th>Merk</th>
                <th>Type</th>
                <th>Prijs</th>
            </tr>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['merk']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['prijs']; ?></td>
            </tr>
        </table>
        <form method="post" style="margin-top: 20px;">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="btn_del" style="background-color: #e74c3c;">Verwijderen</button>
        </form>
    </div>
    <a href="fiets.php" class="back-link">Terug naar overzicht</a>
</body>
</html>