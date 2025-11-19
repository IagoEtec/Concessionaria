<?php
require 'conexao.php';

// Dados do formulário
$tipo = $_POST['tipo_veiculo'];
$modelo = $_POST['modelo'];

// Upload da imagem
$imagem_nome = "veiculo_" . time() . ".jpg";

if (move_uploaded_file($_FILES['imagem']['tmp_name'], "uploads/$imagem_nome")) {
    
    // SQL corrigido - usando 'tipo' em vez de 'tipo_veiculo'
    $sql = "INSERT INTO veiculos (tipo, modelo, imagem) 
            VALUES ('$tipo', '$modelo', '$imagem_nome')";
    
    if ($pdo->query($sql)) {
        header("Location: home.php");
    } else {
        echo "Erro: " . $pdo->errorInfo()[2];
    }
    
} else {
    echo "Erro no upload da imagem. Verifique a pasta 'uploads'.";
}
?>