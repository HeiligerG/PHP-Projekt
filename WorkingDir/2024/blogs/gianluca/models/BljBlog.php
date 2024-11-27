<?php
class BljBlog {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            'mysql:host=mysql2.webland.ch;dbname=d041e_urs',
            'd041e_urs_ro',
            'PW_d041e_urs_ro'
        );
    }

    public function getAllBlogs() {
        $query = "SELECT 
                  blog_von as student_name, 
                  blog_url, 
                  jahr as class_year,
                  TRUE as is_active 
              FROM blogs 
              WHERE blog_von NOT LIKE '%<%' 
              AND blog_url != '???' 
              AND jahr = '2024'
              ORDER BY blog_von ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBlog($studentName, $blogUrl, $classYear) {
        $query = "INSERT INTO blogs (blog_von, blog_url, jahr) 
                 VALUES (:student_name, :blog_url, :class_year)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':student_name' => $studentName,
            ':blog_url' => $blogUrl,
            ':class_year' => $classYear
        ]);
    }
}