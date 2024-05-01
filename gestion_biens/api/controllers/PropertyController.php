<?php
include_once '../config/Database.php';
include_once '../models/Property.php';

$database = new Database();
$db = $database->getConnection();

$property = new Property($db);

$requestMethod = $_SERVER["REQUEST_METHOD"];
header("Content-Type: application/json");



switch ($requestMethod) {
    case 'GET':
        if (!empty($_GET['id'])) {
            // Requête GET pour un bien spécifique
            $property->id = $_GET['id'];
            $property->readOne();
    
            if (!empty($property->title)) { // Vérifier que les données ont bien été récupérées
                echo json_encode([
                    'id' => $property->id,
                    'title' => $property->title,
                    'type' => $property->type,
                    'city' => $property->city,
                    'description' => $property->description,
                    'image_url' => $property->image_url
                ]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Bien non trouvé."]);
            }
        } else {
            // Requête GET pour tous les biens
            $stmt = $property->read();
            $num = $stmt->rowCount();
    
            if ($num > 0) {
                $properties_arr = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($properties_arr, $row);
                }
                echo json_encode($properties_arr);
            } else {
                echo json_encode(['message' => 'Aucun bien trouvé.']);
            }
        }
        break;
    

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);

        // S'assurer que toutes les données nécessaires sont présentes
        if (!empty($data['title']) && !empty($data['type']) && !empty($data['city']) && !empty($data['description']) && !empty($data['image_url'])) {
            $property->title = $data['title'];
            $property->type = $data['type'];
            $property->city = $data['city'];
            $property->description = $data['description'];
            $property->image_url = $data['image_url'];  // Gérer comme une URL pour l'instant

            if ($property->create()) {
                http_response_code(201); // Created
                echo json_encode(["message" => "Bien ajouté avec succès"]);
            } else {
                http_response_code(503); // Service unavailable
                echo json_encode(["message" => "Erreur lors de l'ajout du bien"]);
            }
        } else {
            http_response_code(400); // Bad request
            echo json_encode(["message" => "Données manquantes ou incorrectes"]);
        }
        break;


    case 'DELETE':
        // Assurez-vous que l'ID est fourni
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data['id'])) {
            $property->id = $data['id'];
            if ($property->delete()) {
                http_response_code(200); // OK
                echo json_encode(['message' => 'Bien supprimé avec succès.']);
            } else {
                http_response_code(503); // Service unavailable
                echo json_encode(['message' => 'Erreur lors de la suppression du bien.']);
            }
        } else {
            http_response_code(400); // Bad request
            echo json_encode(['message' => 'ID manquant pour la suppression.']);
        }
        break;
        


        case 'PUT':
            $data = json_decode(file_get_contents("php://input"), true);
            if (!empty($data['id'])) {
                $property->id = $data['id'];
                $property->title = $data['title'];
                $property->type = $data['type'];
                $property->city = $data['city'];
                $property->description = $data['description'];
                $property->image_url = $data['image_url'];  // Gestion de l'image comme URL
        
                if ($property->update()) {
                    http_response_code(200); // OK
                    echo json_encode(['message' => 'Bien modifié avec succès.']);
                } else {
                    http_response_code(503); // Service unavailable
                    echo json_encode(['message' => 'Erreur lors de la modification du bien.']);
                }
            } else {
                http_response_code(400); // Bad request
                echo json_encode(['message' => 'ID manquant pour la modification.']);
            }
            break;
        
}