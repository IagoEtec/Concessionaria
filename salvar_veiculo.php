<?php
// Arquivo para processar o cadastro de novos veículos
require 'conexao.php';

// Verifica se o formulário foi submetido
if ($_POST) {
    
    // Captura os dados do formulário
    $tipo = $_POST['tipo_veiculo'];    // Tipo do veículo (carro/moto)
    $marca = $_POST['marca'];          // Marca do veículo
    $modelo = $_POST['modelo'];        // Modelo do veículo
    $ano = $_POST['ano'];              // Ano do veículo
    
    // Processa o upload da imagem
    // Gera um nome único para evitar sobrescrita de arquivos
    $imagem_nome = "veiculo_" . time() . "_" . uniqid() . ".jpg";

    // Move o arquivo enviado para a pasta uploads
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], "uploads/$imagem_nome")) {
        
        // Prepara a query SQL SEM o campo descricao
        $sql = $pdo->prepare("INSERT INTO veiculos (tipo, marca, modelo, ano, imagem) 
                VALUES (:tipo, :marca, :modelo, :ano, :imagem)");
        
        // Executa a query com os parâmetros (SEM descricao)
        if ($sql->execute([
            ':tipo' => $tipo,
            ':marca' => $marca,
            ':modelo' => $modelo,
            ':ano' => $ano,
            ':imagem' => $imagem_nome
        ])) {
            // Redireciona para a home em caso de sucesso
            header("Location: home.php");
            exit;
        } else {
            echo "Erro ao cadastrar veículo: " . implode(", ", $sql->errorInfo());
        }
        
    } else {
        echo "Erro no upload da imagem. Verifique a pasta 'uploads' e permissões.";
    }
} else {
    echo "Formulário não submetido.";
}
?>