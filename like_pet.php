<?php
session_start();
require_once 'PHP/config.php';

if (!isset($_SESSION['user_id'])) {
    echo 'NOT_LOGGED_IN';
    exit;
}

$user_id = $_SESSION['user_id'];
$dier_id = isset($_POST['dier_id']) ? intval($_POST['dier_id']) : 0;
$richting = isset($_POST['richting']) ? $_POST['richting'] : 'LIKE';

if ($dier_id) {
    // Check if dier_id exists in the database
    $check = $pdo->prepare("SELECT id FROM dier WHERE id = ?");
    $check->execute([$dier_id]);
    if (!$check->fetch()) {
        echo 'INVALID_DIER_ID';
        exit;
    }
    // Save swipe action
    $stmt_swipe = $pdo->prepare("INSERT INTO swipe (gebruiker_id, dier_id, richting) VALUES (?, ?, ?)");
    $stmt_swipe->execute([$user_id, $dier_id, $richting]);

    if ($richting === 'LIKE') {
        // Add to favorites if not already there
        $stmt = $pdo->prepare("SELECT id FROM favoriet WHERE gebruiker_id = ? AND dier_id = ?");
        $stmt->execute([$user_id, $dier_id]);
        if (!$stmt->fetch()) {
            $add = $pdo->prepare("INSERT INTO favoriet (gebruiker_id, dier_id, datumToegevoegd) VALUES (?, ?, NOW())");
            $add->execute([$user_id, $dier_id]);
        }
    }
    echo "SUCCESS";
} else {
    echo "ERROR";
} 