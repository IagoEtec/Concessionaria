<?php
require 'conexao.php';

// Verifica se tem o ID
if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM veiculos WHERE id = :id");
$stmt->execute([":id" => $id]);

$veiculo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$veiculo) {
    die("Veículo não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Veículo</title>
    <link rel="stylesheet" href="assets/css/adicionar_veiculos.css">
</head>
<body>

<div class="container">
    <h2>Editar Veículo</h2>

    <form action="processa_edicao.php" method="POST" enctype="multipart/form-data">
        
        <!-- ID oculto -->
        <input type="hidden" name="id" value="<?php echo $veiculo['id']; ?>">

        <label for="tipo">Tipo de Veículo</label>
        <select id="tipo" name="tipo" required>
            <option value="carro" <?php if($veiculo['tipo']=='carro') echo 'selected'; ?>>Carro</option>
            <option value="moto" <?php if($veiculo['tipo']=='moto') echo 'selected'; ?>>Moto</option>
        </select>

        <label for="modelo">Modelo</label>
        <input type="text" id="modelo" name="modelo" value="<?php echo $veiculo['modelo']; ?>" required>

        <label for="descricao">Descrição</label>
        <textarea id="descricao" name="descricao" rows="4" required><?php echo $veiculo['descricao']; ?></textarea>

        <label for="imagem">Imagem Atual</label>
        <img src="uploads/<?php echo $veiculo['imagem']; ?>" width="150" style="border-radius:8px; display:block; margin-bottom:10px;">

        <label for="imagem">Trocar Imagem (opcional)</label>
        <input type="file" id="imagem" name="imagem" accept="image/*">

        <button type="submit">Salvar Alterações</button>
    </form>

    <a href="home.php" class="btn-voltar">Voltar</a>
</div>

</body>
</html>
