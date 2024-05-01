<?php
class Property {
    private $conn;
    private $table_name = "properties";

    public $id;
    public $title;
    public $type;
    public $city;
    public $description;
    public $image_url;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Méthode pour lire toutes les propriétés
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (title, type, city, description, image_url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Nettoyer les données
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));

        // Lier les données
        $stmt->bindParam(1, $this->title);
        $stmt->bindParam(2, $this->type);
        $stmt->bindParam(3, $this->city);
        $stmt->bindParam(4, $this->description);
        $stmt->bindParam(5, $this->image_url);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
    
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, type = :type, city = :city, description = :description, image_url = :image_url
                  WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
    
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':image_url', $this->image_url);
    
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Assigner les valeurs
        $this->title = $row['title'];
        $this->type = $row['type'];
        $this->city = $row['city'];
        $this->description = $row['description'];
        $this->image_url = $row['image_url'];
    }
    
}
?>