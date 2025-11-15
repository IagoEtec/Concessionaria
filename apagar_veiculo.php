<?php
require 'conexao.php';

if (!isset($_GET['id'])) {
    die("ID não enviado.");
}

$id = $_GET['id'];

$sql = "DELETE FROM veiculos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: home.php?msg=excluido");
    exit;
} else {
    echo "Erro ao excluir veículo.";
}
?>
