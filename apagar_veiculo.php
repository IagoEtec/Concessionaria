<?php
require 'conexao.php';

// Verifica se exite o ID envaido pela URL
if (isset($_GET['id'])) {
    // coloca na variavel
    $id = $_GET['id'];
    
    // deleta
    $sql = "DELETE FROM veiculos WHERE id = $id";
    
    // executa o comando SQL no banco de dados 
    if ($pdo->query($sql)) {
        header("Location: home.php");
    } else {
        echo "Erro ao excluir veículo";
    }
}
?>