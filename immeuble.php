<?php
require_once 'config.php';

// Fonction pour créer un immeuble
function create_immeuble($building_name,$adresse,$nombre_lots) {
    global $bdd;
    $query = $bdd->prepare("INSERT INTO Immeuble (building_name, adresse,nombre_lots) VALUES (?, ?,?)");
    $query->execute([$building_name, $adresse,$nombre_lots]);
    return $bdd->lastInsertId();
}

// Fonction pour lire les informations d'un immeuble
function read_immeuble($building_id) {
    global $bdd;
    $query = $bdd->prepare("SELECT * FROM Immeuble WHERE building_id = ?");
    $query->execute([$building_id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour mettre à jour les informations d'un immeuble
function update_immeuble($building_id, $building_name, $adresse,$nombre_lots) {
    global $bdd;
    $query = $bdd->prepare("UPDATE Immeuble SET building_name = ?, adresse = ?,nombre_lots = ? WHERE building_id = ?");
    $query->execute([$building_name, $adresse, $$nombre_lots,$building_id]);
    return true;
}

// Fonction pour supprimer un immeuble
function delete_immeuble($building_id) {
    global $bdd;
    $query = $bdd->prepare("DELETE FROM Immeuble WHERE building_id = ?");
    $query->execute([$building_id]);
    return true;
}
?>
