<?php
require 'db.php';
require 'config.php';

// session_start(); // já feito em db.php

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF protection
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        die('Requisição inválida (CSRF).');
    }

    $id = $_POST['id'] ?? null;
    if ($id && ctype_digit((string)$id)) {
        $id = (int)$id;
        
        try {
            $stmt = $pdo->prepare("DELETE FROM carros WHERE idcar = ?");
            $stmt->execute([$id]);
            
            header('Location: admin.php?deleted=1');
            exit;
        } catch (PDOException $e) {
            die("Erro ao excluir carro: " . $e->getMessage());
        }
    }
}

header('Location: admin.php');
exit;
?>