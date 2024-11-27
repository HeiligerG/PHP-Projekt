<?php

define('Base_URL', '/PHP-Projekt/WorkingDir/2024/blogs/gianluca');

function redirect($path) {
    header("Location: " . BASE_URL . $path);
    exit();
}

function formatDate($date) {
    if (!$date) return '';

    setlocale(LC_TIME, 'de_DE.utf8', 'de_DE', 'deu_deu');
    $timestamp = strtotime($date);

    if (date('Y-m-d') == date('Y-m-d', $timestamp)) {
        return 'Heute, ' . date('H:i', $timestamp);
    }

    if (date('Y-m-d', strtotime('-1 day')) == date('Y-m-d', $timestamp)) {
        return 'Gestern, ' . date('H:i', $timestamp);
    }

    return date('d.m.Y, H:i', $timestamp);
}

function getRelativeTime($date) {
    $timestamp = strtotime($date);
    $difference = time() - $timestamp;

    if ($difference < 60) {
        return 'Gerade eben';
    } elseif ($difference < 3600) {
        $minutes = floor($difference / 60);
        return "vor {$minutes} " . ($minutes == 1 ? 'Minute' : 'Minuten');
    } elseif ($difference < 86400) {
        $hours = floor($difference / 3600);
        return "vor {$hours} " . ($hours == 1 ? 'Stunde' : 'Stunden');
    } elseif ($difference < 172800) {
        return 'Gestern';
    } else {
        return formatDate($date);
    }
}



function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function displayError($message) {
    return "<div class='bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-lg mb-4'>{$message}</div>";
}

function displaySuccess($message) {
    return "<div class='bg-green-500/10 border border-green-500 text-green-500 p-4 rounded-lg mb-4'>{$message}</div>";
}

function getInitials($username) {
    if (!$username) return '??';
    return strtoupper(substr($username, 0, 2));
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('/PHP-Projekt/WorkingDir/2024/blogs/gianluca/login');
    }
}

function formatNumber($number) {
    if ($number >= 1000000) {
        return round($number / 1000000, 1) . 'M';
    } elseif ($number >= 1000) {
        return round($number / 1000, 1) . 'K';
    }
    return $number;
}

function truncateText($text, $length = 150) {
    if (mb_strlen($text) <= $length) {
        return $text;
    }

    return mb_substr($text, 0, $length) . '...';
}

function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>