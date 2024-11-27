<?php
require_once __DIR__ . '/../includes/database.php';

class Rating {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function addRating($postId, $userId, $rating) {
        try {
            $query = "INSERT INTO ratings (post_id, user_id, rating) 
                     VALUES (:post_id, :user_id, :rating)
                     ON DUPLICATE KEY UPDATE rating = :rating";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':post_id', $postId, PDO::PARAM_INT);
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':rating', $rating, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getAverageRating($postId) {
        $query = "SELECT AVG(rating) as avg_rating, COUNT(*) as rating_count 
                 FROM ratings WHERE post_id = :post_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':post_id', $postId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getUserRating($postId, $userId) {
        $query = "SELECT rating FROM ratings 
                 WHERE post_id = :post_id AND user_id = :user_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':post_id', $postId, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
}
?>