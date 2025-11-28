<?php
// Inclui o cabeçalho que já inicia a sessão
include 'includes/header.php';

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Verificações básicas de segurança e permissão
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'cliente') {
    die("Acesso negado.");
}

// Verifica se o ID do veículo foi passado pela URL
if (!isset($_GET['id'])) {
    die("Veículo não especificado.");
}

$veiculo_id = $_GET['id'];

// Busca informações do veículo no banco de dados
$sql = $pdo->prepare("SELECT * FROM veiculos WHERE id = ?");
$sql->execute([$veiculo_id]);
$veiculo = $sql->fetch();

if (!$veiculo) {
    die("Veículo não encontrado.");
}

// Processa o agendamento quando o formulário é submetido
if ($_POST) {
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $usuario_id = $_SESSION['id'];

    // Prepara query para inserir o agendamento no banco
    $sql = $pdo->prepare("INSERT INTO test_drives (id_usuario, id_veiculo, data_agendamento, horario_agendamento)
                          VALUES (?, ?, ?, ?)");

    if ($sql->execute([$usuario_id, $veiculo_id, $data, $horario])) {

        // Atualiza status do veículo para indisponível
        $update = $pdo->prepare("UPDATE veiculos SET disponivel = 0 WHERE id = ?");
        $update->execute([$veiculo_id]);

        echo "<script>
                alert('Agendamento realizado com sucesso!');
                window.location.href='home.php';
              </script>";
    } else {
        echo "<script>alert('Erro ao fazer agendamento.');</script>";
    }
}
?>

<!-- Link para o arquivo CSS específico desta página -->
<link rel="stylesheet" href="assets/css/agendamento.css">

<!-- Container principal do formulário de agendamento -->
<div class="container">
    <h2>Agendar Test Drive</h2>
    
    <!-- Seção com informações do veículo selecionado -->
    <div class="veiculo-info">
        <h3><?php echo $veiculo['modelo']; ?></h3>
        <p><strong>Marca:</strong> <?php echo $veiculo['marca']; ?></p>
        <p><strong>Ano:</strong> <?php echo $veiculo['ano']; ?></p>
        <p><strong>Tipo:</strong> <?php echo ucfirst($veiculo['tipo']); ?></p>
    </div>

    <!-- Formulário de agendamento -->
    <form method="POST">
        <!-- Campo para selecionar data do test drive -->
        <label for="data">Data do Test Drive:</label>
        <input type="date" id="data" name="data" required>
        
        <!-- Select para escolher horário do test drive -->
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
        
        <!-- Botão para confirmar o agendamento -->
        <button type="submit">Confirmar Agendamento</button>
    </form>
    
    <!-- Link para voltar à página inicial -->
    <a href="home.php" class="voltar">← Voltar para Home</a>
</div>

<?php
// Inclui o rodapé da página
include 'includes/footer.php';
?>