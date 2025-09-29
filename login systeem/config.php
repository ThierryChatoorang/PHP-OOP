<?php
//waar mijn database ligt vaak in the localhost 
$host = 'localhost';

//database naam , die ik heb gemaakt in phpmyadmin
$dbname = 'fietsenmaker';

//datbase gebruikersnaam
$user = 'root';

//database wachtwoord
$pass = '';//lokale server zonder wachtwoord

//Optioneel : defineer een DSN (Data Source Name) voor gemakkelijker gebruik in je PDO verbinding
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

// dit is een standaard optie array die meegegeven wordt aan de PDO constructor.en is om fouten aan te tonen als ze optreden
//voorbeeld van zo iets is dat je een typfout maak in je SQL query
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];
