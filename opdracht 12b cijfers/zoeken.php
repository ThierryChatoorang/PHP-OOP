<!DOCTYPE html>
<!-- De DOCTYPE declaratie voor HTML5, geeft aan dat dit document HTML5 volgt. -->
<html>
<head>
    <meta charset="UTF-8">
    <!-- Zorgt voor de juiste karakterset encoding (UTF-8), ondersteunt meerdere talen en speciale karakters. -->
    <title>Cijferlijst</title>
    <!-- Titel van de webpagina zoals getoond in het tabblad van de browser. -->
    <style>
        /* Interne CSS-stijlen voor het opmaken van de tabel en formuliervelden. */
        table, th, td {
            border: 1px solid black; /* Maakt een zwarte rand van 1px rond tabellen en cellen. */
            border-collapse: collapse; /* Verwijdert dubbele randen tussen cellen. */
        }

        th, td {
            padding: 8px; /* Voegt 8px padding toe binnenin de tabelheader (th) en cellen (td) voor betere leesbaarheid. */
            text-align: left; /* Links uitlijnen van tekst in de header en cellen. */
        }

        th {
            cursor: pointer; /* Verandert de cursor in een pointer (handje) om aan te geven dat de header klikbaar is voor sortering. */
        }

        form {
            margin-bottom: 20px; /* Voegt 20px marge toe onder het formulier voor ruimte tussen het formulier en de tabel. */
        }
    </style>
</head>
<body>

<form action="" method="get">
    <!-- Formulier voor het zoeken naar leerlingen. Gebruikt GET-methode voor de zoekopdracht. -->
    <label for="search">Zoek leerling:</label>
    <input type="text" id="search" name="search" value="">
    <!-- Tekstveld voor het invoeren van de zoekopdracht. -->
    <input type="submit" value="Zoeken">
</form>

<?php
include 'connect.php'; // Include het bestand 'connect.php' voor de databaseverbinding.
$search = $_GET['search'] ?? ''; // Haalt de zoekterm op uit de URL of zet een lege string als standaard.

// Bereidt een SQL-query voor met een placeholder voor de zoekterm.
$query = $db->prepare("SELECT * FROM cijfers WHERE leerling LIKE :search ORDER BY leerling");
$query->bindValue(':search', '%' . $search . '%'); // Vervangt de placeholder door de zoekterm, omgeven door procenttekens voor gedeeltelijke overeenkomsten.
$query->execute(); // Voert de query uit.
$result = $query->fetchAll(PDO::FETCH_ASSOC); // Haalt de resultaten op als een associatieve array.

echo "<table>"; // Start de HTML-tabel.
echo "<tr><th onclick='sortTable(0)'>Leerling</th><th onclick='sortTable(1)'>Cijfer</th><th onclick='sortTable(2)'>Vak</th><th onclick='sortTable(3)'>Docent</th></tr>";
// Headerrij met kolommen, die ook dienen als knoppen voor sortering.

foreach ($result as $row) {
    // Loopt door elk resultaat en voegt een rij toe aan de tabel voor elke record.
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['leerling']) . "</td>";
    echo "<td>" . htmlspecialchars($row['cijfer']) . "</td>";
    echo "<td>" . htmlspecialchars($row['vak']) . "</td>";
    echo "<td>" . htmlspecialchars($row['docent']) . "</td>";
    echo "</tr>";
    // Toont de data van elke leerling met htmlspecialchars om XSS-aanvallen te voorkomen.
}
echo "</table>"; // Sluit de tabel af.
?>

<script src="app.js"></script>
</body>
</html>