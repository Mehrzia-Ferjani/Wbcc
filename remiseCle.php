<?php
require_once 'config.php';

// Fonction pour créer une remise de clé
function create_remise_cle($lot_id,$giver_id, $receiver_id, $image_video, $date_remise, $commentaire, $signature) {
    global $bdd;
    $query = $bdd->prepare("INSERT INTO RemiseCle (lot_id,giver_id, receiver_id, image_video, date_remise, commentaire, signature) VALUES (?,?, ?, ?, ?, ?, ?)");
    $query->execute([$lot_id,$giver_id, $receiver_id, $image_video, $date_remise, $commentaire, $signature]);
    return $bdd->lastInsertId();
}

// Fonction pour lire les informations d'une remise de clé
function read_remise_cle($remise_id) {
    global $bdd;
    $query = $bdd->prepare("SELECT * FROM RemiseCle WHERE remise_id = ?");
    $query->execute([$remise_id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour mettre à jour les informations d'une remise de clé
function update_remise_cle($giver_id, $receiver_id, $image_video, $date_remise, $commentaire, $signature,$remise_id) {
    global $bdd;
    $query = $bdd->prepare("UPDATE RemiseCle SET giver_id = ?, receiver_id = ?, image_video = ?, date_remise = ?, commentaire = ?, signature = ? WHERE remise_id = ?");
    $query->execute([$giver_id, $receiver_id, $image_video, $date_remise, $commentaire, $signature, $remise_id]);
    return true;
}

// Fonction pour supprimer une remise de clé
function delete_remise_cle($remise_id) {
    global $bdd;
    $query = $bdd->prepare("DELETE FROM RemiseCle WHERE remise_id = ?");
    $query->execute([$remise_id]);
    return true;
}
?>
