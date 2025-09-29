<?php
require 'db.connect.php';

$filter_maand = $_GET['maand'] ?? '';
$filter_land = $_GET['land'] ?? '';

$sql = "SELECT * FROM bezoekers WHERE 1";

if (!empty($filter_maand)) {
    $sql .= " AND MONTH(datum_tijd) = " . intval($filter_maand);
}
if (!empty($filter_land)) {
    $sql .= " AND land = '" . $conn->real_escape_string($filter_land) . "'";
}

$result = $conn->query($sql);
?>

<h2>Beheerderspagina - Statistieken</h2>
<form method="get">
    Filter op maand (1-12): <input type="number" name="maand" min="1" max="12">
    Filter op land: <input type="text" name="land">
    <input type="submit" value="Filteren">
</form>

<table border="1" cellpadding="5">
    <tr>
        <th>Land</th>
        <th>IP-adres</th>
        <th>Provider</th>
        <th>Browser</th>
        <th>Datum/Tijd</th>
        <th>Referer</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= htmlspecialchars($row['land']) ?></td>
        <td><?= htmlspecialchars($row['ip_adres']) ?></td>
        <td><?= htmlspecialchars($row['provider']) ?></td>
        <td><?= htmlspecialchars($row['browser']) ?></td>
        <td><?= htmlspecialchars($row['datum_tijd']) ?></td>
        <td><?= htmlspecialchars($row['referer']) ?></td>
    </tr>
    <?php } ?>
</table>

<?php
$conn->close();
?>
