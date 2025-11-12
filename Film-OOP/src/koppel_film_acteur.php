<?php
require_once 'classes/User.php';  // ALLEEN DIT!

$database = new Database();
$db = $database->getConnection();

$film = new Film($db);
$acteur = new Acteur($db);
$filmActeur = new FilmActeur($db);

$message = "";
$error = "";

// Koppeling toevoegen
if($_POST) {
    $filmActeur->film_id = $_POST['film_id'];
    $filmActeur->acteur_id = $_POST['acteur_id'];

    if($filmActeur->bestaatKoppeling()) {
        $error = "⚠️ Deze koppeling bestaat al!";
    } else {
        if($filmActeur->koppel()) {
            $message = "✅ Acteur succesvol gekoppeld aan film!";
        } else {
            $error = "❌ Er ging iets mis bij het koppelen.";
        }
    }
}

// Alle films en acteurs ophalen voor dropdowns
$films_stmt = $film->readAll();
$acteurs_stmt = $acteur->readAll();

// Alle koppelingen ophalen voor overzicht
$koppelingen_stmt = $filmActeur->getAlleKoppelingen();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film & Acteur Koppelen - Film Database</title>
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
            grid-template-columns: 1fr 1.5fr;
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

        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
            cursor: pointer;
        }

        select:focus {
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

        .koppelingen-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .koppelingen-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }

        .koppelingen-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .koppelingen-table tr:hover {
            background: #f9f9f9;
        }

        .film-info {
            font-weight: bold;
            color: #333;
        }

        .acteur-info {
            color: #666;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }

        .badge-nationaliteit {
            background: #28a745;
            color: white;
        }

        .geen-data {
            text-align: center;
            color: #999;
            padding: 40px;
        }

        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .info-box p {
            color: #333;
            line-height: 1.6;
            margin: 0;
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
            <a href="acteur_toevoegen.php">Acteurs</a>
            <a href="koppel_film_acteur.php" class="active">Koppelen</a>
        </div>
    </nav>

    <div class="container">
        <!-- FORM SECTION -->
        <div class="form-section">
            <h2>🔗 Koppelen</h2>

            <div class="info-box">
                <p><strong>ℹ️ Instructie:</strong><br>
                Selecteer een film en een acteur om ze aan elkaar te koppelen. Dit zorgt ervoor dat de acteur wordt gekoppeld aan de geselecteerde film.</p>
            </div>
            
            <?php if($message): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <?php if($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="film_id">🎬 Selecteer Film *</label>
                    <select id="film_id" name="film_id" required>
                        <option value="">-- Kies een film --</option>
                        <?php while($film_row = $films_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $film_row['id']; ?>">
                                <?php echo htmlspecialchars($film_row['titel']) . " (" . $film_row['jaar'] . ")"; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="acteur_id">⭐ Selecteer Acteur *</label>
                    <select id="acteur_id" name="acteur_id" required>
                        <option value="">-- Kies een acteur --</option>
                        <?php while($acteur_row = $acteurs_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $acteur_row['id']; ?>">
                                <?php echo htmlspecialchars($acteur_row['naam']) . " - " . htmlspecialchars($acteur_row['nationaliteit']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <button type="submit">🔗 Koppel Acteur aan Film</button>
            </form>
        </div>

        <!-- LIST SECTION -->
        <div class="list-section">
            <h2>📋 Alle Koppelingen (<?php echo $koppelingen_stmt->rowCount(); ?>)</h2>

            <?php if($koppelingen_stmt->rowCount() > 0): ?>
                <table class="koppelingen-table">
                    <thead>
                        <tr>
                            <th>Film</th>
                            <th>Acteur</th>
                            <th>Nationaliteit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $koppelingen_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td>
                                    <div class="film-info">🎬 <?php echo htmlspecialchars($row['titel']); ?></div>
                                    <small style="color: #999;">(<?php echo $row['jaar']; ?>)</small>
                                </td>
                                <td>
                                    <div class="acteur-info">⭐ <?php echo htmlspecialchars($row['naam']); ?></div>
                                </td>
                                <td>
                                    <span class="badge badge-nationaliteit">
                                        <?php echo htmlspecialchars($row['nationaliteit']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="geen-data">
                    <p>😔 Nog geen koppelingen gemaakt</p>
                    <p>Koppel acteurs aan films met het formulier!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>