<?php require 'config.php'; $docenten = $conn->query("SELECT id, naam FROM docenten"); ?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ziekmelding doorgeven</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background-color: white;
      padding: 30px;
      border-radius: 8px;
      width: 400px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
      color: #555;
    }

    select,
    input[type="date"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }

    select:focus,
    input[type="date"]:focus,
    textarea:focus {
      outline: none;
      border-color: coral;
    }

    button {
      width: 100%;
      padding: 12px;
      margin-bottom: 10px;
      background-color: coral;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #ff5722;
    }

    button a {
      color: white;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Ziekmelding doorgeven</h1>
    <form action="insert_melding.php" method="post">
      <label for="docent_id">Kies docent:</label>
      <select name="docent_id" required>
        <option value="">-- Kies een docent --</option>
        <?php while ($row = $docenten->fetch_assoc()): ?>
          <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['naam']) ?></option>
        <?php endwhile; ?>
      </select>
       
      <label for="datum">Datum:</label>
      <input type="date" name="datum" required>
       
      <label for="reden">Reden:</label>
      <textarea name="reden" rows="4" required></textarea>
       
      <button type="submit">Ziekmelding versturen</button>
      <button><a href="overzicht.php">Terug naar overzicht</a></button>
    </form>
  </div>
</body>
</html>