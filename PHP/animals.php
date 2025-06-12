<?php
require_once 'config.php';

function getAllDieren() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM dier");
    return $stmt->fetchAll();
}

function getDierenBySoort($soort) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM dier WHERE soort = ?");
    $stmt->execute([$soort]);
    return $stmt->fetchAll();
}

function getDierById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM dier WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function searchDieren($query) {
    global $pdo;
    $search = "%$query%";
    $stmt = $pdo->prepare("SELECT * FROM dier WHERE naam LIKE ? OR beschrijving LIKE ?");
    $stmt->execute([$search, $search]);
    return $stmt->fetchAll();
}
?> 