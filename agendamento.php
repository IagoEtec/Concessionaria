<?php
session_start();
require_once 'conexao.php';

// Verificações básicas
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'cliente') {
    die("Acesso negado.");
}

if (!isset($_GET['id'])) {
    die("Veículo não especificado.");
}

$veiculo_id = $_GET['id'];

// Busca veículo
$sql = "SELECT * FROM veiculos WHERE id = $veiculo_id";
// consulta sql no banco de dados usando PDO
$resultado = $pdo->query($sql);
// pega o resultado da primeira linha e usa o fetch p retornar como array associativo
$veiculo = $resultado->fetch();

// Verifica se encontrou algm veiculo no banco
if (!$veiculo) {
    // encerra execução e mostra msg de erro
    die("Veículo não encontrado.");
}

// Processa agendamento
if ($_POST) {
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $usuario_id = $_SESSION['id'];
    
    // Corrigido: usa 'tipo' em vez de 'tipo_veiculo'
    $sql = "INSERT INTO teste_drive (tipo_veiculo, modelo, data, horario, id_usuario, id_veiculo) 
            VALUES ('{$veiculo['tipo']}', '{$veiculo['modelo']}', '$data', '$horario', $usuario_id, $veiculo_id)";
    
    if ($pdo->query($sql)) {
        echo "<script>alert('Agendamento realizado com sucesso!'); window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('Erro ao fazer agendamento.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agendar Test Drive</title>
    <link rel="stylesheet" href="assets/css/agendamento.css">
</head>
<body>

    <div class="container">
        <h2>Agendar Test Drive</h2>
        
        <div class="veiculo-info">
            <h3><?php echo $veiculo['modelo']; ?></h3>
            <p>Tipo: <?php echo $veiculo['tipo']; ?></p>
            <p><?php echo $veiculo['descricao']; ?></p>
        </div>

        <form method="POST">
            <label for="data">Data do Test Drive:</label>
            <input type="date" id="data" name="data" required>
            
            <label for="horario">Horário:</label>
            <select id="horario" name="horario" required>
                <option value="">Selecione um horário</option>
                <option value="08:00:00">08:00</option>
                <option value="09:00:00">09:00</option>
                <option value="10:00:00">10:00</option>
                <option value="11:00:00">11:00</option>
                <option value="14:00:00">14:00</option>
                <option value="15:00:00">15:00</option>
                <option value="16:00:00">16:00</option>
                <option value="17:00:00">17:00</option>
            </select>
            
            <button type="submit">Confirmar Agendamento</button>
        </form>
        
        <a href="home.php" class="voltar">← Voltar para Home</a>
    </div>

</body>
</html>