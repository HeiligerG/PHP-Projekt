<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../models/Post.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Nicht autorisiert']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $postId = isset($matches[1]) ? (int)$matches[1] : 0;

    $post = new Post();
    if ($post->deletePost($postId, $_SESSION['user_id'])) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Löschen fehlgeschlagen']);
    }
    exit;
}
?>