<?php
// Inclure le fichier de configuration de la base de données
require_once 'config.php';

// Inclure le fichier contenant les fonctions CRUD pour les utilisateurs
require_once 'utilisateur.php';

// Inclure le fichier contenant les fonctions CRUD pour les lots
require_once 'lot.php';

// Inclure le fichier contenant les fonctions CRUD pour les immeubles
require_once 'immeuble.php';
// Inclure le fichier contenant les fonctions CRUD pour les remises
require_once 'remiseCle.php';

// Récupérer la méthode de la requête HTTP et le chemin d'accès
$httpMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Routes pour gérer les utilisateurs
if (strpos($requestUri, '/utilisateurs') === 0) {
    // Route pour créer un utilisateur
    if ($httpMethod === 'POST' && $requestUri === '/utilisateurs/add') {
        // Récupérer les données du corps de la requête
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];
        $role = $data['role'];

        // Appeler la fonction pour créer un utilisateur
        create_utilisateur($username, $role);

        // Retourner une réponse JSON avec un message de succès et un code HTTP 201 (Created)
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Utilisateur créé avec succès']);
        http_response_code(201);
    }

    // Route pour lire un utilisateur
    elseif ($httpMethod === 'GET' && strpos($requestUri, '/utilisateurs/') === 0) {
        // Récupérer l'ID de l'utilisateur à partir de l'URL
        $userId = substr($requestUri, strlen('/utilisateurs/'));

        // Appeler la fonction pour lire un utilisateur
        $utilisateur = read_utilisateur($userId);

        // Retourner une réponse JSON avec les informations de l'utilisateur
        header('Content-Type: application/json');
        echo json_encode($utilisateur);
    }

    // Route pour mettre à jour un utilisateur
    elseif ($httpMethod === 'PUT' && strpos($requestUri, '/utilisateurs/update/') === 0) {
        // Récupérer l'ID de l'utilisateur à partir de l'URL
        $userId = substr($requestUri, strlen('/utilisateurs/update/'));

        // Récupérer les données du corps de la requête
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];
        $role = $data['role'];

        // Appeler la fonction pour mettre à jour un utilisateur
        update_utilisateur($userId, $username, $role);

        // Retourner une réponse JSON avec un message de succès
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Utilisateur mis à jour avec succès']);
    }

    // Route pour supprimer un utilisateur
    elseif ($httpMethod === 'DELETE' && strpos($requestUri, '/utilisateurs/delete/') === 0) {
        // Récupérer l'ID de l'utilisateur à partir de l'URL
        $userId = substr($requestUri, strlen('/utilisateurs/delete/'));

        // Appeler la fonction pour supprimer un utilisateur
        delete_utilisateur($userId);

        // Retourner une réponse JSON avec un message de succès
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Utilisateur supprimé avec succès']);
    }
}

// Routes pour gérer les immeubles
if (strpos($requestUri, '/immeubles') === 0) {
    // Route pour créer un immeuble
    if ($httpMethod === 'POST' && $requestUri === '/immeubles/add') {
        // Récupérer les données du corps de la requête
        $data = json_decode(file_get_contents('php://input'), true);
        $building_name = $data['building_name'];
        $adresse = $data['adresse'];
        $nombre_lots = $data['nombre_lots'];

        // Appeler la fonction pour créer un immeuble
        create_immeuble($building_name, $adresse, $nombre_lots);

        // Retourner une réponse JSON avec un message de succès et un code HTTP 201 (Created)
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Immeuble créé avec succès']);
        http_response_code(201);
    }

    // Route pour lire un immeuble
    elseif ($httpMethod === 'GET' && strpos($requestUri, '/immeubles/') === 0) {
        // Récupérer l'ID de l'immeuble à partir de l'URL
        $building_id = substr($requestUri, strlen('/immeubles/'));

        // Appeler la fonction pour lire un immeuble
        $immeuble = read_immeuble($building_id);

        // Retourner une réponse JSON avec les informations de l'immeuble
        header('Content-Type: application/json');
        echo json_encode($immeuble);
    }

    // Route pour mettre à jour un immeuble
    elseif ($httpMethod === 'PUT' && strpos($requestUri, '/immeubles/update/') === 0) {
        // Récupérer l'ID de l'immeuble à partir de l'URL
        $building_id = substr($requestUri, strlen('/immeubles/update/'));

        // Récupérer les données du corps de la requête
        $data = json_decode(file_get_contents('php://input'), true);
        $building_name = $data['building_name'];
        $adresse = $data['adresse'];
        $nombre_lots = $data['nombre_lots'];

        // Appeler la fonction pour mettre à jour un immeuble
        update_immeuble($building_id, $building_name, $adresse, $nombre_lots);

        // Retourner une réponse JSON avec un message de succès
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Immeuble mis à jour avec succès']);
    }

    // Route pour supprimer un immeuble
    elseif ($httpMethod === 'DELETE' && strpos($requestUri, '/immeubles/delete/') === 0) {
        // Récupérer l'ID de l'immeuble à partir de l'URL
        $immeubleId = substr($requestUri, strlen('/immeubles/delete/'));

        // Appeler la fonction pour supprimer un immeuble
        delete_immeuble($immeubleId);

        // Retourner une réponse JSON avec un message de succès
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Immeuble supprimé avec succès']);
    }
}
// Routes pour gérer les lots
if (strpos($requestUri, '/lots') === 0) {
    // Route pour créer un lot
    if ($httpMethod === 'POST' && $requestUri === '/lots/add') {
        // Récupérer les données du corps de la requête
        $data = json_decode(file_get_contents('php://input'), true);
        // $lot_number = $data['lot_number'];
        $building_id = $data['building_id'];
        $owner_id = $data['owner_id'];

        // Appeler la fonction pour créer un lot
        create_lot($building_id, $owner_id);

        // Retourner une réponse JSON avec un message de succès et un code HTTP 201 (Created)
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Lot créé avec succès']);
        http_response_code(201);
    }

    // Route pour lire un lot
    elseif ($httpMethod === 'GET' && strpos($requestUri, '/lots/') === 0) {
        // Récupérer l'ID du lot à partir de l'URL
        $lot_id = substr($requestUri, strlen('/lots/'));

        // Appeler la fonction pour lire un lot
        $lot = read_lot($lot_id);

        // Retourner une réponse JSON avec les informations du lot
        header('Content-Type: application/json');
        echo json_encode($lot);
    }

    // Route pour mettre à jour un lot
    elseif ($httpMethod === 'PUT' && strpos($requestUri, '/lots/update/') === 0) {
        // Récupérer l'ID du lot à partir de l'URL
        $lotId = substr($requestUri, strlen('/lots/update/'));

        // Récupérer les données du corps de la requête
        $data = json_decode(file_get_contents('php://input'), true);
        //$lot_number = $data['lot_number'];
        $building_id = $data['building_id'];
        $owner_id = $data['owner_id'];

        // Appeler la fonction pour mettre à jour un lot
        update_lot($lot_id, $building_id, $owner_id);

        // Retourner une réponse JSON avec un message de succès
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Lot mis à jour avec succès']);
    }

    // Route pour supprimer un lot
    elseif ($httpMethod === 'DELETE' && strpos($requestUri, '/lots/delete/') === 0) {
        // Récupérer l'ID du lot à partir de l'URL
        $lot_id = substr($requestUri, strlen('/lots/delete/'));

        // Appeler la fonction pour supprimer un lot
        delete_lot($lot_id);

        // Retourner une réponse JSON avec un message de succès
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Lot supprimé avec succès']);
    }
}
// Routes pour gérer les remises de clés
if (strpos($requestUri, '/remises-cles') === 0) {
    // Route pour créer une remise de clé
    // Vérification de la méthode HTTP et de l'URI
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/remises-cles/add') {
        // Récupérer les données du corps de la requête
        $data = json_decode(file_get_contents('php://input'), true);
        $lot_id = isset($data['lot_id']) ? $data['lot_id'] : null;
        $giver_id = isset($data['giver_id']) ? $data['giver_id'] : null;
        $receiver_id = isset($data['receiver_id']) ? $data['receiver_id'] : null;
        $date_remise = isset($data['date_remise']) ? $data['date_remise'] : null;
        $commentaire = isset($data['commentaire']) ? $data['commentaire'] : null;
        $signature = isset($data['signature']) ? $data['signature'] : null;
        // Vérifier si une image a été téléchargée
        if (isset($_FILES['image_video']) && $_FILES['image_video']['error'] === UPLOAD_ERR_OK) {
            // Récupérer les détails de l'image vidéo
            $image_video = $_FILES['image_video'];

            // Chemin de destination pour enregistrer l'image vidéo
            $upload_directory = './uploads/';
            $image_video_path = $upload_directory . $image_video['name'];

            // Déplacer l'image vidéo téléchargée vers le dossier de téléchargement
            move_uploaded_file($image_video['tmp_name'], $image_video_path);
        } else {
            // Si aucune image vidéo n'a été téléchargée, définir $image_video_path sur null ou une valeur par défaut
            $image_video_path = null;
        }
        // Appeler la fonction pour créer une remise de clé
        if (create_remise_cle($lot_id, $giver_id, $receiver_id, $image_path, $date_remise, $commentaire, $signature)) {
            // Retourner une réponse JSON avec un message de succès et un code HTTP 201 (Created)
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Remise de clé créée avec succès']);
            http_response_code(201);
        } else {
            // Retourner une réponse JSON avec un message d'erreur et un code HTTP 500 (Internal Server Error)
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Erreur lors de la création de la remise de clé']);
            http_response_code(500);
        }
    }
    // Route pour lire une remise de clé
    elseif ($httpMethod === 'GET' && strpos($requestUri, '/remises-cles/') === 0) {
        // Récupérer l'ID de la remise de clé à partir de l'URL
        $remise_id = substr($requestUri, strlen('/remises-cles/'));

        // Appeler la fonction pour lire une remise de clé
        $remiseCle = read_remise_cle($remise_id);

        // Retourner une réponse JSON avec les informations de la remise de clé
        header('Content-Type: application/json');
        echo json_encode($remiseCle);
    }

    // Route pour mettre à jour une remise de clé
    elseif ($httpMethod === 'PUT' && strpos($requestUri, '/remises-cles/update/') === 0) {
        // Récupérer l'ID de la remise de clé à partir de l'URL
        $remise_id = substr($requestUri, strlen('/remises-cles/update/'));

        // Récupérer les données du corps de la requête
        $data = json_decode(file_get_contents('php://input'), true);
        $lot_id = $data['lot_id'];
        $giver_id = $data['giver_id'];
        $receiver_id = $data['receiver_id'];
        $image_video = $data['image_video'];
        $date_remise = $data['date_remise'];
        $commentaire = $data['commentaire'];
        $signature = $data['signature'];

        // Appeler la fonction pour mettre à jour une remise de clé
        update_remise_cle($remise_id, $lot_id, $giver_id, $receiver_id, $image_video, $date_remise, $commentaire, $signature);

        // Retourner une réponse JSON avec un message de succès
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Remise de clé mise à jour avec succès']);
    }

    // Route pour supprimer une remise de clé
    elseif ($httpMethod === 'DELETE' && strpos($requestUri, '/remises-cles/delete/') === 0) {
        // Récupérer l'ID de la remise de clé à partir de l'URL
        $remiseCleId = substr($requestUri, strlen('/remises-cles/delete/'));

        // Appeler la fonction pour supprimer une remise de clé
        delete_remise_cle($remiseCleId);

        // Retourner une réponse JSON avec un message de succès
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Remise de clé supprimée avec succès']);
    }
}
