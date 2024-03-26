<?php
require_once 'config.php';
// Fonction pour créer un utilisateur
function create_utilisateur($username, $role) {
    global $bdd;
    $query = $bdd->prepare("INSERT INTO Utilisateur (username, role) VALUES (?, ?)");
    $query->execute([$username, $role]);
    return $bdd->lastInsertId();
}

// Fonction pour lire les informations d'un utilisateur
function read_utilisateur($user_id) {
    global $bdd;
    $query = $bdd->prepare("SELECT * FROM Utilisateur WHERE user_id = ?");
    $query->execute([$user_id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour mettre à jour les informations d'un utilisateur
function update_utilisateur($user_id, $username, $role) {
    global $bdd;
    $query = $bdd->prepare("UPDATE Utilisateur SET username = ?, role = ? WHERE user_id = ?");
    $query->execute([ $user_id,$username, $role]);
    return true;
}

// Fonction pour supprimer un utilisateur
function delete_utilisateur($user_id) {
    global $bdd;
    $query = $bdd->prepare("DELETE FROM Utilisateur WHERE user_id = ?");
    $query->execute([$user_id]);
    return true;
}
?>