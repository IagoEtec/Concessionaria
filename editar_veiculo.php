<?php
// Arquivo para edição de veículos existentes
require 'conexao.php';

// Verifica se o ID do veículo foi passado pela URL
if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = $_GET['id']; // ID do veículo a ser editado

// Prepara e executa consulta para buscar dados do veículo
$stmt = $pdo->prepare("SELECT * FROM veiculos WHERE id = :id");
$stmt->execute([":id" => $id]);

// Busca os dados do veículo
$veiculo = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o veículo foi encontrado
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

    <!-- Formulário de edição com dados pré-preenchidos -->
    <form action="processa_edicao.php" method="POST" enctype="multipart/form-data">
        
        <!-- Campo oculto para enviar o ID do veículo -->
        <input type="hidden" name="id" value="<?php echo $veiculo['id']; ?>">

        <label for="tipo">Tipo de Veículo</label>
        <select id="tipo" name="tipo" required>
            <option value="carro" <?php if($veiculo['tipo']=='carro') echo 'selected'; ?>>Carro</option>
            <option value="moto" <?php if($veiculo['tipo']=='moto') echo 'selected'; ?>>Moto</option>
        </select>

        <!-- Campos separados com names diferentes -->
        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" value="<?php echo $veiculo['marca']; ?>" required>

        <label for="modelo">Modelo</label>
        <input type="text" id="modelo" name="modelo" value="<?php echo $veiculo['modelo']; ?>" required>

        <label for="ano">Ano</label>
        <input type="number" id="ano" name="ano" value="<?php echo $veiculo['ano']; ?>" required>


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