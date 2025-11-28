<?php
// Conecta ao banco de dados
require 'conexao.php';

// Verifica se o ID foi enviado pelo formulario
if (!isset($_POST['id'])) {
    exit("ID nao informado.");
}

$id = $_POST['id'];               // ID do veiculo a ser atualizado
$tipo = $_POST['tipo'];  // Novo tipo (carro/moto)
$modelo = $_POST['modelo'];      // Novo modelo
$descricao = $_POST['descricao']; // Nova descricao

// -----------------------------
// 1. BUSCA A IMAGEM ANTIGA NO BANCO
// -----------------------------
$sql = $pdo->prepare("SELECT imagem FROM veiculos WHERE id = :id");
$sql->execute([":id" => $id]);
$dados = $sql->fetch(PDO::FETCH_ASSOC);

if (!$dados) {
    exit("Veiculo nao encontrado.");
}

$imagemAntiga = $dados['imagem']; // Nome do arquivo antigo

// -----------------------------
// 2. VERIFICA SE O USUARIO ENVIOU UMA NOVA IMAGEM
// -----------------------------
if (!empty($_FILES['imagem']['name'])) {

    // Cria um nome unico para a nova imagem
    $novaImg = uniqid() . "_" . $_FILES['imagem']['name'];

    // Caminho para salvar a nova imagem
    $destino = "uploads/" . $novaImg;

    // Move o arquivo enviado para a pasta uploads/
    if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
        exit("Erro ao enviar nova imagem.");
    }

    // Se existia imagem antiga, remove para nao ocupar espaco no servidor
    if ($imagemAntiga && file_exists("uploads/" . $imagemAntiga)) {
        unlink("uploads/" . $imagemAntiga);
    }

} else {
    // Se nao enviou imagem nova, mantem a antiga
    $novaImg = $imagemAntiga;
}

// -----------------------------
// 3. ATUALIZA AS INFORMACOES NO BANCO
// -----------------------------
$update = $pdo->prepare("
    UPDATE veiculos 
    SET tipo = :tipo, modelo = :modelo, descricao = :descricao, imagem = :img 
    WHERE id = :id
");

// Executa a atualizacao com os valores enviados
$update->execute([
    ":tipo" => $tipo,
    ":modelo" => $modelo,
    ":descricao" => $descricao,
    ":img" => $novaImg,
    ":id" => $id
]);

// Depois de atualizar, redireciona para a home
header("Location: home.php?msg=editado");
exit;
?>
