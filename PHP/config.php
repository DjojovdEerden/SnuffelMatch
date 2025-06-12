<?php
$host = 'localhost';
$dbname = 'snuffelmatch';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Create gebruiker table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS gebruiker (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        wachtwoord VARCHAR(255) NOT NULL,
        voornaam VARCHAR(100) NOT NULL,
        achternaam VARCHAR(100) NOT NULL,
        telefoon VARCHAR(20),
        adres TEXT,
        postcode VARCHAR(10),
        stad VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?> 