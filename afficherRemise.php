<?php
// Ajout de la logique pour récupérer les données depuis la base de données et les afficher
require_once 'config.php';
// Exemple de réponse JSON avec des données fictives
$remises = [
    ['id' => 1, 'lot_id' => 123, 'giver_id' => 456, 'receiver_id' => 789, 'date_remise' => '2024-03-26', 'commentaire' => 'Remise de clé pour le lot A', 'signature' => 'John Doe'],
    ['id' => 2, 'lot_id' => 456, 'giver_id' => 789, 'receiver_id' => 123, 'date_remise' => '2024-03-27', 'commentaire' => 'Remise de clé pour le lot B', 'signature' => 'Jane Doe']
];

// Envoi des données au format JSON
header('Content-Type: application/json');
echo json_encode($remises);
?>
