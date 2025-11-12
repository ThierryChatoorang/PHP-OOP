<?php
require_once 'classes/User.php'; 

$database = new Database();
$db = $database->getConnection();

$film = new Film($db);

$message = "";
$error = "";

// Genres lijst
$genres = ['Action', 'Adventure', 'Comedy', 'Crime', 'Drama', 'Fantasy', 'Horror', 'Romance', 'Sci-Fi', 'Thriller'];

if($_POST) {
    $film->titel = $_POST['titel'];
    $film->genre = $_POST['genre'];
    $film->jaar = $_POST['jaar'];
    $film->beschrijving = $_POST['beschrijving'];

    if($film->create()) {
        $message = "✅ Film succesvol toegevoegd!";
        $_POST = array();
    } else {
        $error = "❌ Er ging iets mis bij het toevoegen van de film.";
    }
}

// Alle films ophalen voor overzicht
$films_stmt = $film->readAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Toevoegen - Film Database</title>
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
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
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

        .films-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .films-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }

        .films-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .films-table tr:hover {
            background: #f9f9f9;
        }

        .genre-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #667eea;
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
            <a href="film_toevoegen.php" class="active">Films</a>
            <a href="acteur_toevoegen.php">Acteurs</a>
            <a href="koppel_film_acteur.php">Koppelen</a>
        </div>
    </nav>

    <div class="container">
        <!-- FORM SECTION -->
        <div class="form-section">
            <h2>🎥 Film Toevoegen</h2>
            
            <?php if($message): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <?php if($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="titel">📽️ Film Titel *</label>
                    <input type="text" id="titel" name="titel" placeholder="Bijv. Inception" required>
                </div>

                <div class="form-group">
                    <label for="genre">🎭 Genre *</label>
                    <select id="genre" name="genre" required>
                        <option value="">-- Selecteer een genre --</option>
                        <?php foreach($genres as $genre_option): ?>
                            <option value="<?php echo $genre_option; ?>"><?php echo $genre_option; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jaar">📅 Jaar *</label>
                    <input type="number" id="jaar" name="jaar" min="1900" max="2030" placeholder="Bijv. 2010" required>
                </div>

                <div class="form-group">
                    <label for="beschrijving">📝 Beschrijving</label>
                    <textarea id="beschrijving" name="beschrijving" placeholder="Korte beschrijving van de film..."></textarea>
                </div>

                <button type="submit">➕ Film Toevoegen</button>
            </form>
        </div>

        <!-- LIST SECTION -->
        <div class="list-section">
            <h2>📚 Alle Films (<?php echo $films_stmt->rowCount(); ?>)</h2>

            <?php if($films_stmt->rowCount() > 0): ?>
                <table class="films-table">
                    <thead>
                        <tr>
                            <th>Titel</th>
                            <th>Genre</th>
                            <th>Jaar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $films_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($row['titel']); ?></strong></td>
                                <td><span class="genre-badge"><?php echo htmlspecialchars($row['genre']); ?></span></td>
                                <td><?php echo $row['jaar']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="geen-data">
                    <p>😔 Nog geen films toegevoegd</p>
                    <p>Voeg je eerste film toe met het formulier!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>