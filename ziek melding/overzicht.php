<?php
require 'config.php';


$search = isset($_GET['search']) ? $_GET['search'] : '';
$stmt = $conn->prepare("
    SELECT z.id, d.naam, z.datum, z.reden 
    FROM ziekmeldingen z
    JOIN docenten d ON z.docent_id = d.id
    WHERE d.naam LIKE ?
    ORDER BY z.datum DESC
");
$like = "%$search%";
$stmt->bind_param("s", $like);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Overzicht Ziekmeldingen</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-image: url('home.jpg');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .table-container {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 10px;
      width: 90%;
      max-width: 1000px;
      box-shadow: 0 0 15px rgba(0,0,0,0.3);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      text-align: center;
      margin-bottom: 20px;
    }

    input[type="text"] {
      padding: 8px;
      width: 250px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      padding: 8px 15px;
      margin-left: 10px;
      background-color: wheat;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: coral;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>
<body>
  <div class="table-container">
    <h1>Overzicht</h1

    <form method="get" action="">
      <input type="text" name="search" placeholder="Zoek op docent..." value="<?= htmlspecialchars($search) ?>">
      <button type="submit">Zoeken</button>
      <button type="submit"><a href="ziekmelden.php">Ziekmelding doorgeven</a></button>
    </form>

    <table>
      <tr>
        <th>Docent</th>
        <th>Datum</th>
        <th>Reden</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['naam']) ?></td>
        <td><?= htmlspecialchars($row['datum']) ?></td>
        <td><?= nl2br(htmlspecialchars($row['reden'])) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
