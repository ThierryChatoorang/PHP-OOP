<?php
require_once 'classes/User.php'; 

$database = new Database();
$db = $database->getConnection();


$film = new Film($db);
$acteur = new Acteur($db);
$filmActeur = new FilmActeur($db);

// Statistieken ophalen
$total_films = $film->count();
$total_acteurs = $acteur->count();
$total_koppelingen = $filmActeur->count();

// Recente films
$films_stmt = $film->readAll();
$films_array = $films_stmt->fetchAll(PDO::FETCH_ASSOC);
$recent_films = array_slice($films_array, 0, 5);

// Recente acteurs
$acteurs_stmt = $acteur->readAll();
$acteurs_array = $acteurs_stmt->fetchAll(PDO::FETCH_ASSOC);
$recent_acteurs = array_slice($acteurs_array, 0, 5);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Film Database</title>
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

        .nav-links a:hover {
            background: #667eea;
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome {
            background: white;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
        }

        .welcome h2 {
            color: #667eea;
            font-size: 36px;
            margin-bottom: 15px;
        }

        .welcome p {
            color: #666;
            font-size: 18px;
            line-height: 1.6;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-10px);
        }

        .stat-icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 48px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-size: 18px;
            font-weight: 600;
        }

        .action-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .action-card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
        }

        .action-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .action-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .action-card h3 {
            color: #667eea;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .action-card p {
            color: #666;
            line-height: 1.6;
        }

        .recent-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 30px;
        }

        .recent-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .recent-box h3 {
            color: #667eea;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }

        .recent-list {
            list-style: none;
        }

        .recent-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: background 0.3s;
        }

        .recent-item:last-child {
            border-bottom: none;
        }

        .recent-item:hover {
            background: #f9f9f9;
        }

        .recent-item strong {
            color: #333;
            font-size: 16px;
        }

        .recent-item span {
            color: #999;
            font-size: 14px;
            margin-left: 10px;
        }

        .geen-data {
            text-align: center;
            color: #999;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .recent-section {
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
            <a href="koppel_film_acteur.php">Koppelen</a>
        </div>
    </nav>

    <div class="container">
        <div class="welcome">
            <h2>👋 Welkom bij de Film Database</h2>
            <p>Beheer je complete filmcollectie, registreer acteurs en koppel ze aan films</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🎥</div>
                <div class="stat-number"><?php echo $total_films; ?></div>
                <div class="stat-label">Films</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <div class="stat-number"><?php echo $total_acteurs; ?></div>
                <div class="stat-label">Acteurs</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🔗</div>
                <div class="stat-number"><?php echo $total_koppelingen; ?></div>
                <div class="stat-label">Koppelingen</div>
            </div>
        </div>

        <div class="action-cards">
            <a href="film_toevoegen.php" class="action-card">
                <div class="action-icon">🎬</div>
                <h3>Film Toevoegen</h3>
                <p>Voeg een nieuwe film toe met genre en beschrijving</p>
            </a>

            <a href="acteur_toevoegen.php" class="action-card">
                <div class="action-icon">🌟</div>
                <h3>Acteur Registreren</h3>
                <p>Registreer een nieuwe acteur in de database</p>
            </a>

            <a href="koppel_film_acteur.php" class="action-card">
                <div class="action-icon">🔗</div>
                <h3>Koppelen</h3>
                <p>Koppel acteurs aan films</p>
            </a>
        </div>

        <div class="recent-section">
            <div class="recent-box">
                <h3>📽️ Recente Films</h3>
                <?php if(count($recent_films) > 0): ?>
                    <ul class="recent-list">
                        <?php foreach($recent_films as $film_item): ?>
                            <li class="recent-item">
                                <strong><?php echo htmlspecialchars($film_item['titel']); ?></strong>
                                <span>(<?php echo $film_item['jaar']; ?>) - <?php echo htmlspecialchars($film_item['genre']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="geen-data">Nog geen films toegevoegd</div>
                <?php endif; ?>
            </div>

            <div class="recent-box">
                <h3>⭐ Recente Acteurs</h3>
                <?php if(count($recent_acteurs) > 0): ?>
                    <ul class="recent-list">
                        <?php foreach($recent_acteurs as $acteur_item): ?>
                            <li class="recent-item">
                                <strong><?php echo htmlspecialchars($acteur_item['naam']); ?></strong>
                                <span><?php echo htmlspecialchars($acteur_item['nationaliteit']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="geen-data">Nog geen acteurs geregistreerd</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>