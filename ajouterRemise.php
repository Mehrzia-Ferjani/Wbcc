<?php
require_once 'config.php';
// Vérification de la méthode HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $lot_id = $_POST['lot_id'];
    $giver_id = $_POST['giver_id'];
    $receiver_id = $_POST['receiver_id'];
    $date_remise = $_POST['date_remise'];
    $commentaire = $_POST['commentaire'];
    $signature = $_POST['signature'];

    // Traitement de l'image
    $target_dir = "uploads/"; // Dossier où vous souhaitez stocker les images
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Vérifier si le fichier est une image réelle ou une fausse image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        // Si le fichier est une image réelle, le télécharger
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Le téléchargement de l'image a réussi, vous pouvez enregistrer les données dans la base de données ici

            // Exemple de réponse JSON
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Remise de clé ajoutée avec succès']);
            http_response_code(201);
        } else {
            // Le téléchargement de l'image a échoué
            http_response_code(500);
            echo json_encode(['message' => 'Erreur lors du téléchargement de l\'image']);
        }
    } else {
        // Le fichier n'est pas une image valide
        http_response_code(400);
        echo json_encode(['message' => 'Le fichier n\'est pas une image valide']);
    }
} else {
    // Méthode HTTP non autorisée
    http_response_code(405);
}
?>
