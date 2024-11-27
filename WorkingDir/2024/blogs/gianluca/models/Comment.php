<?php
require_once __DIR__ . '/../includes/database.php';

class Comment {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getCommentsByPostId($postId) {
        $query = "SELECT c.*, u.username 
                 FROM comments c 
                 JOIN users u ON c.user_id = u.id 
                 WHERE c.post_id = :post_id 
                 ORDER BY c.created_at DESC";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':post_id', $postId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function createComment($postId, $userId, $content) {
        $query = "INSERT INTO comments (post_id, user_id, content) 
                 VALUES (:post_id, :user_id, :content)";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':post_id', $postId, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':content', $content);

        return $stmt->execute();
    }
public function deleteComment($commentId, $userId) {
    try {
        $checkQuery = "SELECT COUNT(*) FROM comments 
                     WHERE id = :id AND user_id = :user_id";
        $checkStmt = $this->db->prepare($checkQuery);
        $checkStmt->bindValue(':id', $commentId, PDO::PARAM_INT);
        $checkStmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $checkStmt->execute();
        
        if ($checkStmt->fetchColumn() > 0) {
            $deleteQuery = "DELETE FROM comments WHERE id = :id";
            $deleteStmt = $this->db->prepare($deleteQuery);
            $deleteStmt->bindValue(':id', $commentId, PDO::PARAM_INT);
            return $deleteStmt->execute();
        }
        return false;
    } catch (PDOException $e) {
        error_log("Fehler beim Löschen des Kommentars: " . $e->getMessage());
        return false;
    }
}}
?>