<?php
require 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM veiculos WHERE id = $id";
    
    if ($pdo->query($sql)) {
        header("Location: home.php");
    } else {
        echo "Erro ao excluir veículo";
    }
}
?>