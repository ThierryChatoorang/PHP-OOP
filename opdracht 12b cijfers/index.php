<!DOCTYPE html>
<!-- De DOCTYPE declaratie voor HTML5, geeft aan dat dit document HTML5 volgt. -->
<html>
<head>
    <meta charset="UTF-8">
    <!-- Zorgt voor de juiste karakterset encoding (UTF-8), ondersteunt meerdere talen en speciale karakters. -->
    <title>Cijferlijst</title>
    <!-- Titel van de webpagina zoals getoond in het tabblad van de browser. -->
    <style>
        /* CSS voor het stylen van de tabel en knoppen */
        table, th, td {
            border: 1px solid black; /* Voegt een zwarte rand toe aan tabel en cellen */
            border-collapse: collapse; /* Combineert de randen van aangrenzende cellen */
        }

        th, td {
            padding: 8px; /* Ruimte binnen de cellen voor betere leesbaarheid */
            text-align: left; /* Text links uitlijnen */
        }

        th {
            cursor: pointer; /* Verandert de cursor naar een handje bij het hoveren over kolomkoppen */
        }

        form {
            margin-bottom: 20px; /* Voegt ruimte onder het zoekformulier toe */
        }
        
        .btn-delete {
            background-color: red; /* Rode achtergrondkleur voor de verwijderknop */
            color: white; /* Witte tekstkleur */
            padding: 5px 10px; /* Ruimte binnen de knop */
            text-decoration: none; /* Geen onderstreping van de linktekst */
            border-radius: 3px; /* Afgeronde hoeken */
        }
        
        .btn-delete:hover {
            background-color:darkred; /* Donkerder rood bij hover voor feedback */
        }
        
        .action-links {
            margin-top: 20px; /* Ruimte boven de actielinks */
        }
        
        .action-links a {
            background-color: green; /* Groene achtergrondkleur */
            color: white; /* Witte tekstkleur */
            padding: 8px 16px; /* Ruimte binnen de link */
            text-decoration: none; /* Geen onderstreping */
            border-radius: 4px; /* Afgeronde hoeken */
            margin-right: 10px; /* Ruimte rechts van de link */
        }
        
        .action-links a:hover {
            background-color: #45a049; /* Donkerder groen bij hover */
        }
    </style>
</head>
<body>

<!-- Zoekformulier voor het filteren van leerlingen -->
<form action="" method="get">
    <label for="search">Zoek leerling:</label>
    <!-- Input veld met behoud van de zoekterm na het verzenden -->
    <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
    <input type="submit" value="Zoeken">
</form>

<?php
// Inclusie van het database connectie bestand
include 'connect.php';

// Ophalen van de zoekterm uit de URL of lege string als er geen zoekterm is
$search = $_GET['search'] ?? '';

// Voorbereiden van de SQL query met een placeholder voor veilige zoekopdrachten
$query = $pdo->prepare("SELECT * FROM cijfers WHERE leerling LIKE :search ORDER BY leerling");

// Binden van de zoekterm aan de placeholder, met % tekens voor gedeeltelijke overeenkomsten
$query->bindValue(':search', '%' . $search . '%');

// Uitvoeren van de query
$query->execute();

// Ophalen van alle resultaten als een associatieve array
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Begin van de HTML tabel
echo "<table>";

// Tabelkop met sorteerbare kolommen en een actiekolom
echo "<tr>
        <th onclick='sortTable(0)'>Leerling</th>
        <th onclick='sortTable(1)'>Cijfer</th>
        <th onclick='sortTable(2)'>Vak</th>
        <th onclick='sortTable(3)'>Docent</th>
        <th>Acties</th>
      </tr>";

// Loop door elk resultaat om een tabelrij aan te maken
foreach ($result as $row) {
    echo "<tr>";
    // Weergave van leerlinggegevens met bescherming tegen XSS-aanvallen via htmlspecialchars
    echo "<td>" . htmlspecialchars($row['leerling']) . "</td>";
    echo "<td>" . htmlspecialchars($row['cijfer']) . "</td>";
    echo "<td>" . htmlspecialchars($row['vak']) . "</td>";
    echo "<td>" . htmlspecialchars($row['docent']) . "</td>";
    
    // Verwijderknop met bevestigingsdialoog
    echo "<td><a href='verwijder.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Weet je zeker dat je dit cijfer wilt verwijderen?\");'>Verwijderen</a></td>";
    echo "</tr>";
}

// Afsluiten van de tabel
echo "</table>";
?>

<!-- Sectie voor navigatielinks -->
<div class="action-links">
    <a href="invoeren.php">Nieuw cijfer invoeren</a>
</div>

<!-- Verwijzing naar het JavaScript bestand voor tabel functionaliteit zoals sorteren -->
<script src="app.js"></script>
</body>
</html>

