<?php
$host = '127.0.0.1'; // Adresse du serveur MySQL
$dbname = 'Wbcc'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur MySQL
$password = ''; // Mot de passe MySQL

try {
    // Connexion à la base de données
    $bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la table Utilisateur
    $bdd->exec("CREATE TABLE IF NOT EXISTS Utilisateur (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50),
        role ENUM('copropriétaire', 'agent')
    )");

    // Création de la table Immeuble
    $bdd->exec("CREATE TABLE IF NOT EXISTS Immeuble (
        building_id INT AUTO_INCREMENT PRIMARY KEY,
        building_name VARCHAR(100),
        adresse VARCHAR(100),
        nombre_lots INT
    )");

    // Création de la table Lot
    $bdd->exec("CREATE TABLE IF NOT EXISTS Lot (
        lot_id INT AUTO_INCREMENT PRIMARY KEY,
        building_id INT,
        owner_id INT,
        FOREIGN KEY (building_id) REFERENCES Immeuble(building_id),
        FOREIGN KEY (owner_id) REFERENCES Utilisateur(user_id)
    )");

    // Création de la table RemiseCle
    $bdd->exec("CREATE TABLE IF NOT EXISTS RemiseCle (
        remise_id INT AUTO_INCREMENT PRIMARY KEY,
        giver_id INT,
        receiver_id INT,
        lot_id INT,
        date_remise DATE,
        commentaire TEXT,
        signature VARCHAR(100),
        image_video BLOB,
        FOREIGN KEY (giver_id) REFERENCES Utilisateur(user_id),
        FOREIGN KEY (receiver_id) REFERENCES Utilisateur(user_id),
        FOREIGN KEY (lot_id) REFERENCES Lot(lot_id)
    )");

    echo "Tables créées avec succès ! Connecter à votre base de donnée";
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>