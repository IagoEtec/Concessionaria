<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Acesso inválido.');
}

$tipo = $_POST['tipo_veiculo'];
$modelo = $_POST['modelo'];
$descricao = $_POST['descricao'];

// Upload da imagem
$imagem = uniqid() . "_" . $_FILES['imagem']['name'];

if (!move_uploaded_file($_FILES['imagem']['tmp_name'], "uploads/$imagem")) {
    exit("Erro ao enviar imagem.");
}

// Inserir no banco
$sql = "INSERT INTO veiculos (tipo_veiculo, modelo, imagem, descricao)
        VALUES (:tipo, :modelo, :img, :desc)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ":tipo" => $tipo,
    ":modelo" => $modelo,
    ":img" => $imagem,
    ":desc" => $descricao
]);

header("Location: home.php");
exit;
?>
