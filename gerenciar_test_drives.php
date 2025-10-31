<?php
require 'db.php';
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Verificar se o usuário é atendente
$stmt = $pdo->prepare("SELECT tipo FROM login WHERE idlog = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if ($user['tipo'] !== 'atendente') {
    header('Location: catalogo.php');
    exit;
}

// Processar ações
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $test_drive_id = $_POST['test_drive_id'] ?? null;
    
    if ($test_drive_id && in_array($action, ['aprovar', 'negar'])) {
        try {
            $status = $action === 'aprovar' ? 'aprovado' : 'negado';
            
            $stmt = $pdo->prepare("UPDATE test_drives SET status = ? WHERE id = ?");
            $stmt->execute([$status, $test_drive_id]);
            
            // Se aprovado, marcar carro como indisponível para test drive
            if ($action === 'aprovar') {
                $stmt = $pdo->prepare("SELECT id_carro FROM test_drives WHERE id = ?");
                $stmt->execute([$test_drive_id]);
                $test_drive = $stmt->fetch();
                
                $stmt = $pdo->prepare("UPDATE carros SET disponivel_test_drive = 0 WHERE idcar = ?");
                $stmt->execute([$test_drive['id_carro']]);
            }
            
            header('Location: gerenciar_test_drives.php?success=1');
            exit;
        } catch (PDOException $e) {
            $error = "Erro ao processar solicitação: " . $e->getMessage();
        }
    }
}

// Buscar todos os test drives
$stmt = $pdo->query("
    SELECT td.*, l.username as cliente, c.titulo as carro_titulo 
    FROM test_drives td 
    JOIN login l ON td.id_cliente = l.idlog 
    JOIN carros c ON td.id_carro = c.idcar 
    ORDER BY td.criado_em DESC
");
$test_drives = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Test Drives - Select Car Motors</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>

  <main class="container">
    <h2>Gerenciar Test Drives</h2>
    
    <?php if (isset($error)): ?>
        <div style="background: rgba(239,68,68,0.1); color: #ef4444; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(239,68,68,0.3);">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['success'])): ?>
        <div style="background: rgba(16,185,129,0.1); color: #10b981; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(16,185,129,0.3);">
            Ação realizada com sucesso!
        </div>
    <?php endif; ?>
    
    <?php if (empty($test_drives)): ?>
        <div style="text-align: center; padding: 3rem; color: var(--muted);">
            <p>Nenhum test drive solicitado.</p>
        </div>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Carro</th>
                        <th>Data do Agendamento</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($test_drives as $td): ?>
                        <tr>
                            <td><?= htmlspecialchars($td['cliente']) ?></td>
                            <td><?= htmlspecialchars($td['carro_titulo']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($td['data_agendamento'])) ?></td>
                            <td>
                                <span class="status-disponivel 
                                    <?= $td['status'] == 'aprovado' ? 'status-sim' : 
                                       ($td['status'] == 'negado' ? 'status-nao' : 'status-pendente') ?>">
                                    <?= ucfirst($td['status']) ?>
                                </span>
                            </td>
                            <td style="white-space: nowrap;">
                                <?php if ($td['status'] == 'pendente'): ?>
                                    <form action="" method="post" style="display:inline">
                                        <input type="hidden" name="test_drive_id" value="<?= $td['id'] ?>">
                                        <input type="hidden" name="action" value="aprovar">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                        <button type="submit" class="btn-small edit">Aprovar</button>
                                    </form>
                                    <form action="" method="post" style="display:inline">
                                        <input type="hidden" name="test_drive_id" value="<?= $td['id'] ?>">
                                        <input type="hidden" name="action" value="negar">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                        <button type="submit" class="btn-small delete">Negar</button>
                                    </form>
                                <?php else: ?>
                                    <span>Ação realizada</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
  </main>
</body>
</html>