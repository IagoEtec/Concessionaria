<?php
require 'conexao.php';

if (!isset($_POST['id'])) {
    exit("ID não informado.");
}

$id = $_POST['id'];
$tipo = $_POST['tipo_veiculo'];
$modelo = $_POST['modelo'];
$descricao = $_POST['descricao'];

// Busca imagem atual no banco
$sql = $pdo->prepare("SELECT imagem FROM veiculos WHERE id = :id");
$sql->execute([":id" => $id]);
$dados = $sql->fetch(PDO::FETCH_ASSOC);

if (!$dados) {
    exit("Veículo não encontrado.");
}

$imagemAntiga = $dados['imagem'];

// Se o usuário enviou uma nova imagem
if (!empty($_FILES['imagem']['name'])) {

    $novaImg = uniqid() . "_" . $_FILES['imagem']['name'];
    $destino = "uploads/" . $novaImg;

    if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
        exit("Erro ao enviar nova imagem.");
    }

    // Apaga a imagem antiga
    if ($imagemAntiga && file_exists("uploads/" . $imagemAntiga)) {
        unlink("uploads/" . $imagemAntiga);
    }

} else {
    // Mantém a imagem antiga
    $novaImg = $imagemAntiga;
}

// Atualiza o veículo
$update = $pdo->prepare("
    UPDATE veiculos 
    SET tipo_veiculo = :tipo, modelo = :modelo, descricao = :descricao, imagem = :img 
    WHERE id = :id
");

$update->execute([
    ":tipo" => $tipo,
    ":modelo" => $modelo,
    ":descricao" => $descricao,
    ":img" => $novaImg,
    ":id" => $id
]);

header("Location: home.php?msg=editado");
exit;
?>
