<?php
require_once 'includes/config.php';
require_once 'includes/database.php';
require_once 'includes/functions.php';

$request = $_SERVER['REQUEST_URI'];
$basePath = '/2024/blogs/gianluca';
$request = str_replace($basePath, '', $request);

if (preg_match('/^\/api\/comments\/(\d+)$/', $request, $matches)) {
    require __DIR__ . '/api/comments.php';
    exit;
}

if (preg_match('/^\/posts\/edit\/(\d+)$/', $request, $matches)) {
    requireLogin();
    require __DIR__ . '/views/posts/edit.php';
    exit;
}

if (preg_match('/^\/api\/posts\/(\d+)$/', $request, $matches)) {
    require __DIR__ . '/api/posts.php';
    exit;
}

if (preg_match('/^\/api\/ratings$/', $request)) {
    require __DIR__ . '/api/ratings.php';
    exit;
}

switch ($request) {
    case '/home':
    case '/gianluca':
    case '/index':
    case '/':
        require __DIR__ . '/views/posts/index.php';
        break;

    case '/posts/create':
        require __DIR__ . '/views/posts/create.php';
        break;

    case '/posts/my-posts':
        requireLogin();
        require __DIR__ . '/views/posts/my-posts.php';
        break;

    case '/profile/change-password':
        requireLogin();
        require __DIR__ . '/views/profile/change_password.php';
        break;

    case '/profile':
        requireLogin();
        require __DIR__ . '/views/profile/index.php';
        break;

    case '/blogs':
        require __DIR__ . '/views/bljblogs/blogs.php';
        break;

    case '/login':
        require __DIR__ . '/views/auth/login.php';
        break;

    case '/register':
        require __DIR__ . '/views/auth/register.php';
        break;

    case '/logout':
        requireLogin();
        session_destroy();
        redirect('/');
        break;


    default:
        if (preg_match('/^\/post\/(\d+)$/', $request, $matches)) {
            require __DIR__ . '/views/posts/show.php';
        } else {
            http_response_code(404);
            require __DIR__ . '/views/errors/404.php';
        }
        break;
}
?>
