<?php
session_start(); // Start de sessie
include("config.php"); // Verbind met de database

if (isset($_POST["inloggen"])) {
    try {
        // Maak een databaseverbinding
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Haal invoer op
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = $_POST["password"];

        // Controleer of de gebruiker 'admin' is met wachtwoord 'admin'
        if ($username === "admin" && $password === "admin") {
            $_SESSION["gebruikersnaam"] = "admin";
            header("Location: admin.php");
            exit();
        }

        // Zoek gebruiker in database
        $query = $db->prepare("SELECT * FROM gebruikers WHERE username = :username");
        $query->bindParam(":username", $username, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() === 1) {
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Controleer het wachtwoord
            if (password_verify($password, $result["password"])) {
                $_SESSION["gebruikersnaam"] = $result["username"];
                header("Location: welkom.php");
                exit();
            }
        }
        
        // Foutmelding als login mislukt
        echo "Onjuiste gebruikersnaam of wachtwoord.";
    } catch (PDOException $e) {
        echo "Er is een fout opgetreden. Probeer het later opnieuw.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
</head>
<body>
    <h2>Inloggen</h2>
    <form action="" method="post">
        <div>
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <input type="submit" name="inloggen" value="Inloggen">
        </div>
    </form>
    <br>
    <a href="registreren.php">Nog geen account? Registreer hier</a>
</body>
</html>







