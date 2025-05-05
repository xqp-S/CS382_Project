<?php
require_once 'Database.php';

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Create user (id included for tracking but not used in insert)
    public function create($id, $name, $email) {
        $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ss", $name, $email);
        return $stmt->execute();
    }

    // Read all users (optional id can be used for logging/filtering)
    public function readAll($id = null) {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    // Read a single user by ID
    public function read($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update user by ID
    public function update($id, $name, $email) {
        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $id);
        return $stmt->execute();
    }

    // Delete user by ID
    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
