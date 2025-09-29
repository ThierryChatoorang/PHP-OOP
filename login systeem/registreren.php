<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
</head>
<body>
    <h2>Gebruiker Registreren</h2>
    <form action="" method="post">
        <div>
            <label for="username">Gebruikersnaam:</label>
            <input type="text" name="username" id="username" required>
        </div>

        <div>
            <label for="password">Wachtwoord:</label><br>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <input type="submit" name="registreer" value="Registreer">
        </div>
    </form>

    <?php
    if (isset($_POST["registreer"])) {
        // Voeg de databaseconfiguratie toe
        include 'config.php'; // Zorgt ervoor dat configuratiebestand goed is ingesteld

        try {
            // Maak verbinding met de database
            $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Zorg voor foutmelding bij fouten

            // Bereid nieuwe SQL-query voor om een nieuwe gebruiker toe te voegen
            $query = $db->prepare("INSERT INTO gebruikers (username, password) VALUES (:username, :password)");

            // Sanitize de gebruikersnaam en hash het wachtwoord
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Bind de waarden aan de query
            $query->bindParam(':username', $username);
            $query->bindParam(':password', $password);

            // Voer de query uit en controleer op succes
            if ($query->execute()) {
                echo "De nieuwe gebruiker is succesvol toegevoegd.";
            } else {
                echo "Er is iets fout gegaan bij het toevoegen van de nieuwe gebruiker.";
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage()); // Foutmelding als de databaseverbinding niet lukt
        }
    }
    ?>
    
    <br><br><br>
    <a href="inloggen.php">Terug naar de inlogpagina</a>
</body>
</html>


