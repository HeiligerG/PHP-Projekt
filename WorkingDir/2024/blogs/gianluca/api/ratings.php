<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../models/Rating.php';
require_once __DIR__ . '/../models/Post.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Nicht autorisiert']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $postId = (int)($data['post_id'] ?? 0);
    $rating = (int)($data['rating'] ?? 0);

    if ($postId <= 0 || $rating < 1 || $rating > 5) {
        http_response_code(400);
        echo json_encode(['error' => 'Ungültige Bewertung']);
        exit;
    }

    $post = new Post();
    $postData = $post->getPostById($postId);

    if (!$postData) {
        http_response_code(404);
        echo json_encode(['error' => 'Beitrag nicht gefunden']);
        exit;
    }

    if ($postData['user_id'] == $_SESSION['user_id']) {
        http_response_code(403);
        echo json_encode(['error' => 'Sie können Ihren eigenen Beitrag nicht bewerten']);
        exit;
    }

    $ratingModel = new Rating();
    if ($ratingModel->addRating($postId, $_SESSION['user_id'], $rating)) {
        echo json_encode([
            'success' => true,
            'average' => $ratingModel->getAverageRating($postId)
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Bewertung konnte nicht gespeichert werden']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Methode nicht erlaubt']);
?>