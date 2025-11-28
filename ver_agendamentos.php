<?php
// Inclui o cabeçalho que já inicia a sessão
include 'includes/header.php';

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Verifica se está no modo "meus agendamentos" para clientes
if (isset($_GET['meus']) && $_GET['meus'] == 'true') {
    // MODO CLIENTE - Visualizar próprios agendamentos
    
    if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'cliente') {
        die("Acesso negado");
    }

    $usuario_id = $_SESSION['id'];
    $modo_cliente = true;

    // Query para buscar apenas os agendamentos do usuário logado
    $sql = $pdo->prepare("
        SELECT 
            t.id,
            v.modelo AS veiculo,
            v.marca AS marca,
            t.data_agendamento,
            t.horario_agendamento,
            t.status,
            t.data_solicitacao
        FROM test_drives t
        JOIN veiculos v ON v.id = t.id_veiculo
        WHERE t.id_usuario = ?
        ORDER BY t.data_agendamento DESC
    ");
    $sql->execute([$usuario_id]);
    $agendamentos = $sql->fetchAll(PDO::FETCH_ASSOC);
    
} else {
    // MODO ADMINISTRADOR - Visualizar todos agendamentos
    
    if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
        die("Acesso negado");
    }

    $modo_cliente = false;

    // Query para buscar TODOS os agendamentos do sistema
    $sql = $pdo->prepare("
        SELECT 
            t.id,
            u.nome AS usuario,
            v.modelo AS veiculo,
            v.marca AS marca,
            t.data_agendamento,
            t.horario_agendamento,
            t.status,
            t.data_solicitacao
        FROM test_drives t
        JOIN usuarios u ON u.id = t.id_usuario
        JOIN veiculos v ON v.id = t.id_veiculo
        ORDER BY t.data_agendamento ASC
    ");
    $sql->execute();
    $agendamentos = $sql->fetchAll(PDO::FETCH_ASSOC);
}

// Processa ações (tanto para admin quanto para cliente)
if (isset($_GET['acao']) && isset($_GET['id'])) {
    $id_agendamento = $_GET['id'];
    $acao = $_GET['acao'];
    
    $sql = $pdo->prepare("SELECT id_veiculo, id_usuario FROM test_drives WHERE id = ?");
    $sql->execute([$id_agendamento]);
    $agendamento = $sql->fetch(PDO::FETCH_ASSOC);
    
    if ($agendamento) {
        $id_veiculo = $agendamento['id_veiculo'];
        $id_usuario = $agendamento['id_usuario'];
        
        if ($modo_cliente && $acao == 'cancelar' && $id_usuario == $_SESSION['id']) {
            // Cliente cancelando próprio agendamento
            $sql = $pdo->prepare("UPDATE test_drives SET status = 'cancelado' WHERE id = ?");
            $sql->execute([$id_agendamento]);
            $update = $pdo->prepare("UPDATE veiculos SET disponivel = 1 WHERE id = ?");
            $update->execute([$id_veiculo]);
            
        } elseif (!$modo_cliente) {
            // Administrador executando ações
            switch ($acao) {
                case 'confirmar':
                    $sql = $pdo->prepare("UPDATE test_drives SET status = 'confirmado' WHERE id = ?");
                    $sql->execute([$id_agendamento]);
                    break;
                    
                case 'negar':
                    $sql = $pdo->prepare("UPDATE test_drives SET status = 'negado' WHERE id = ?");
                    $sql->execute([$id_agendamento]);
                    $update = $pdo->prepare("UPDATE veiculos SET disponivel = 1 WHERE id = ?");
                    $update->execute([$id_veiculo]);
                    break;
                    
                case 'realizar':
                    $sql = $pdo->prepare("UPDATE test_drives SET status = 'realizado' WHERE id = ?");
                    $sql->execute([$id_agendamento]);
                    $update = $pdo->prepare("UPDATE veiculos SET disponivel = 1 WHERE id = ?");
                    $update->execute([$id_veiculo]);
                    break;
                    
                case 'cancelar':
                    $sql = $pdo->prepare("UPDATE test_drives SET status = 'cancelado' WHERE id = ?");
                    $sql->execute([$id_agendamento]);
                    $update = $pdo->prepare("UPDATE veiculos SET disponivel = 1 WHERE id = ?");
                    $update->execute([$id_veiculo]);
                    break;
            }
        }
        
        $redirect_url = $modo_cliente ? "ver_agendamentos.php?meus=true" : "ver_agendamentos.php";
        header("Location: $redirect_url");
        exit;
    }
}
?>

<!-- Link para o arquivo CSS específico desta página -->
<link rel="stylesheet" href="assets/css/ver_agendamentos.css">

<!-- Título dinâmico baseado no modo -->
<h1><?php echo $modo_cliente ? 'Meus Agendamentos de Test Drive' : 'Agendamentos - Painel Administrativo'; ?></h1>

<?php if (empty($agendamentos) && $modo_cliente): ?>
    <!-- Mensagem quando cliente não tem agendamentos -->
    <div class="sem-agendamentos">
        <p>Você ainda não fez nenhum agendamento.</p>
        <a href="home.php" class="btn-voltar">⟵ Voltar para Veículos</a>
    </div>
<?php else: ?>

<!-- Tabela que mostra os agendamentos -->
<table>
    <tr>
        <?php if (!$modo_cliente): ?>
            <th>ID</th>
            <th>Usuário</th>
        <?php endif; ?>
        <th>Veículo</th>
        <th>Data</th>
        <th>Horário</th>
        <th>Status</th>
        <th>Solicitado em</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($agendamentos as $a): ?>
    <tr>
        <?php if (!$modo_cliente): ?>
            <td><?= $a['id'] ?></td>
            <td><?= $a['usuario'] ?></td>
        <?php endif; ?>
        <td><?= $a['marca'] ?> <?= $a['veiculo'] ?></td>
        <td><?= date('d/m/Y', strtotime($a['data_agendamento'])) ?></td>
        <td><?= substr($a['horario_agendamento'], 0, 5) ?></td>
        <td class="status <?= $a['status'] ?>">
            <?= ucfirst($a['status']) ?>
        </td>
        <td><?= date('d/m/Y H:i', strtotime($a['data_solicitacao'])) ?></td>
        <td>
            <?php if ($modo_cliente): ?>
                <?php if ($a['status'] == 'pendente' || $a['status'] == 'confirmado'): ?>
                    <a href="ver_agendamentos.php?meus=true&acao=cancelar&id=<?= $a['id'] ?>" class="btn-cancelar"
                       onclick="return confirm('Cancelar este agendamento?')">
                        Cancelar
                    </a>
                <?php else: ?>
                    <span>-</span>
                <?php endif; ?>
            <?php else: ?>
                <?php if ($a['status'] == 'pendente'): ?>
                    <a href="ver_agendamentos.php?acao=confirmar&id=<?= $a['id'] ?>" class="btn-confirmar" 
                       onclick="return confirm('Confirmar este agendamento?')">
                        Confirmar
                    </a>
                    <a href="ver_agendamentos.php?acao=negar&id=<?= $a['id'] ?>" class="btn-negar"
                       onclick="return confirm('Negar este agendamento?')">
                        Negar
                    </a>
                <?php elseif ($a['status'] == 'confirmado'): ?>
                    <a href="ver_agendamentos.php?acao=realizar&id=<?= $a['id'] ?>" class="btn-realizar"
                       onclick="return confirm('Marcar como realizado?')">
                        Realizado
                    </a>
                    <a href="ver_agendamentos.php?acao=cancelar&id=<?= $a['id'] ?>" class="btn-cancelar"
                       onclick="return confirm('Cancelar este agendamento?')">
                        Cancelar
                    </a>
                <?php else: ?>
                    <span>-</span>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>

<!-- Botão para voltar para a página inicial -->
<a href="home.php" class="btn-voltar">⟵ Voltar para Home</a>

<?php
// Inclui o rodapé da página
include 'includes/footer.php';
?>