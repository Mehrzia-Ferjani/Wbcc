<?php
require_once 'config.php';

// Fonction pour créer un lot
function create_lot($building_id, $owner_id) {
    global $bdd;
    $query = $bdd->prepare("INSERT INTO Lot (building_id, owner_id) VALUES (?, ?)");
    $query->execute([ $building_id, $owner_id]);
    return $bdd->lastInsertId();
}

// Fonction pour lire les informations d'un lot
function read_lot($lot_id) {
    global $bdd;
    $query = $bdd->prepare("SELECT * FROM Lot WHERE lot_id = ?");
    $query->execute([$lot_id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour mettre à jour les informations d'un lot
function update_lot($lot_id, $building_id,$owner_id) {
    global $bdd;
    $query = $bdd->prepare("UPDATE Lot SET building_id = ?, owner_id = ? WHERE lot_id = ?");
    $query->execute([$building_id,$owner_id, $lot_id]);
    return true;
}

// Fonction pour supprimer un lot
function delete_lot($lot_id) {
    global $bdd;
    $query = $bdd->prepare("DELETE FROM Lot WHERE lot_id = ?");
    $query->execute([$lot_id]);
    return true;
}
?>
