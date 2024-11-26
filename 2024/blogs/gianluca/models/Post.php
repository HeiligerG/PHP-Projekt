<?php
require_once __DIR__ . '/../includes/database.php';

class Post {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllPosts($limit = 10, $offset = 0) {
        $query = "SELECT 
                    p.*, 
                    u.username,
                    (SELECT COUNT(*) FROM comments WHERE post_id = p.id) as comment_count
                  FROM posts p 
                  JOIN users u ON p.user_id = u.id 
                  ORDER BY p.created_at DESC 
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getPostById($id) {
        $query = "SELECT 
                    p.*, 
                    u.username 
                  FROM posts p 
                  JOIN users u ON p.user_id = u.id 
                  WHERE p.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function createPost($userId, $title, $content, $imageUrl = null) {
        $query = "INSERT INTO posts (user_id, title, content, image_url) 
                  VALUES (:user_id, :title, :content, :image_url)";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':image_url', $imageUrl);

        return $stmt->execute();
    }

    public function deletePost($postId, $userId) {
        $query = "DELETE FROM posts WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $postId, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updatePost($postId, $userId, $title, $content, $imageUrl = null) {
        $query = "UPDATE posts 
                 SET title = :title, 
                     content = :content, 
                     image_url = :image_url 
                 WHERE id = :id AND user_id = :user_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $postId, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':image_url', $imageUrl);
        return $stmt->execute();
    }

    public function getPostsByUserId($userId, $limit = 10, $offset = 0) {
        $query = "SELECT p.*, 
                    u.username,
                    (SELECT COUNT(*) FROM comments WHERE post_id = p.id) as comment_count
              FROM posts p 
              JOIN users u ON p.user_id = u.id 
              WHERE p.user_id = :user_id
              ORDER BY p.created_at DESC 
              LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}
?>