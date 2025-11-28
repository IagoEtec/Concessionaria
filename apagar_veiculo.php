<?php
require 'conexao.php';

// Verifica se existe o ID enviado pela URL
if (isset($_GET['id'])) {
    // Coloca na variável e sanitiza
    $id = $_GET['id'];
    
    // Prepara a query usando prepared statement para evitar SQL injection
    $sql = "DELETE FROM veiculos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    // Executa o comando SQL no banco de dados com o parâmetro
    if ($stmt->execute([':id' => $id])) {
        header("Location: home.php");
    } else {
        echo "Erro ao excluir veículo";
    }
} else {
    echo "ID não informado";
}
?>