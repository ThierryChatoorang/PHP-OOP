<?php
require_once 'classes/User.php'; 

$database = new Database();
$db = $database->getConnection();

$acteur = new Acteur($db);

$message = "";
$error = "";

if($_POST) {
    $acteur->naam = $_POST['naam'];
    $acteur->geboortedatum = $_POST['geboortedatum'];
    $acteur->nationaliteit = $_POST['nationaliteit'];

    if($acteur->create()) {
        $message = "✅ Acteur succesvol geregistreerd!";
        $_POST = array();
    } else {
        $error = "❌ Er ging iets mis bij het registreren van de acteur.";
    }
}

// Alle acteurs ophalen
$acteurs_stmt = $acteur->readAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acteur Registreren - Film Database</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: white;
            padding: 20px 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            color: #667eea;
            font-size: 28px;
        }

        .nav-links {
            display: flex;
            gap: 15px;
        }

        .nav-links a {
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border: 2px solid #667eea;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .nav-links a:hover, .nav-links a.active {
            background: #667eea;
            color: white;
        }

        .container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .form-section, .list-section {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        h2 {
            color: #667eea;
            font-size: 28px;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
        }

        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
        }

        .message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .acteurs-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .acteurs-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }

        .acteurs-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .acteurs-table tr:hover {
            background: #f9f9f9;
        }

        .nationaliteit-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #28a745;
            color: white;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        .geen-data {
            text-align: center;
            color: #999;
            padding: 40px;
        }

        @media (max-width: 1200px) {
            .container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🎬 Film Database</h1>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="film_toevoegen.php">Films</a>
            <a href="acteur_toevoegen.php" class="active">Acteurs</a>
            <a href="koppel_film_acteur.php">Koppelen</a>
        </div>
    </nav>

    <div class="container">
        <!-- FORM SECTION -->
        <div class="form-section">
            <h2>⭐ Acteur Registreren</h2>
            
            <?php if($message): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <?php if($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="naam">👤 Volledige Naam *</label>
                    <input type="text" id="naam" name="naam" placeholder="Bijv. Leonardo DiCaprio" required>
                </div>

                <div class="form-group">
                    <label for="geboortedatum">🎂 Geboortedatum *</label>
                    <input type="date" id="geboortedatum" name="geboortedatum" required>
                </div>

                <div class="form-group">
                    <label for="nationaliteit">🌍 Nationaliteit *</label>
                    <input type="text" id="nationaliteit" name="nationaliteit" placeholder="Bijv. Amerikaans, Nederlands" required>
                </div>

                <button type="submit">➕ Acteur Registreren</button>
            </form>
        </div>

        <!-- LIST SECTION -->
        <div class="list-section">
            <h2>🌟 Alle Acteurs (<?php echo $acteurs_stmt->rowCount(); ?>)</h2>

            <?php if($acteurs_stmt->rowCount() > 0): ?>
                <table class="acteurs-table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Geboortedatum</th>
                            <th>Nationaliteit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $acteurs_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($row['naam']); ?></strong></td>
                                <td><?php echo date('d-m-Y', strtotime($row['geboortedatum'])); ?></td>
                                <td><span class="nationaliteit-badge"><?php echo htmlspecialchars($row['nationaliteit']); ?></span></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="geen-data">
                    <p>😔 Nog geen acteurs geregistreerd</p>
                    <p>Registreer je eerste acteur met het formulier!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>