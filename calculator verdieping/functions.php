<?php
require_once 'db_connect.php';

// Berekening opslaan in database
function saveCalculation($expression, $result) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO calculations (expression, result, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$expression, $result]);
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

// Geschiedenis ophalen
function getHistory($limit = 10) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM calculations ORDER BY created_at DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Geschiedenis wissen
function clearHistory() {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM calculations");
        $stmt->execute();
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

// Zoek in geschiedenis
function searchHistory($search) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM calculations WHERE expression LIKE ? OR result LIKE ? ORDER BY created_at DESC");
        $searchTerm = "%$search%";
        $stmt->execute([$searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}
?>