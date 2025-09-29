CREATE DATABASE IF NOT EXISTS gastenboek;

-- Gebruik deze database
USE gastenboek;

-- Maak tabel berichten
CREATE TABLE IF NOT EXISTS berichten (
    id INT(9) NOT NULL AUTO_INCREMENT,
    naam VARCHAR(255) NOT NULL,
    bericht TEXT,
    datumtijd TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);