<?php
require 'db.php';
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id_carro = $_GET['id'] ?? null;
if (!$id_carro) {
    header('Location: catalogo.php');
    exit;
}

// Verificar se o usuário é cliente
$stmt = $pdo->prepare("SELECT tipo FROM login WHERE idlog = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if ($user['tipo'] !== 'cliente') {
    header('Location: catalogo.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_agendamento = $_POST['data_agendamento'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO test_drives (id_cliente, id_carro, data_agendamento) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $id_carro, $data_agendamento]);
        
        header('Location: catalogo.php?success=agendamento');
        exit;
    } catch (PDOException $e) {
        $error = "Erro ao agendar test drive: " . $e->getMessage();
    }
}

// Buscar informações do carro
$stmt = $pdo->prepare("SELECT * FROM carros WHERE idcar = ?");
$stmt->execute([$id_carro]);
$carro = $stmt->fetch();

if (!$carro) {
    header('Location: catalogo.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendar Test Drive - Select Car Motors</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>
  
  <div class="centered">
    <form class="card-form" method="post">
      <h2>Agendar Test Drive</h2>
      
      <?php if (isset($error)): ?>
          <div style="background: rgba(239,68,68,0.1); color: #ef4444; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(239,68,68,0.3);">
              <?= htmlspecialchars($error) ?>
          </div>
      <?php endif; ?>
      
      <div style="text-align: center; margin-bottom: 2rem;">
        <h3><?= htmlspecialchars($carro['titulo']) ?></h3>
        <p style="color: var(--muted);"><?= htmlspecialchars($carro['descricao']) ?></p>
      </div>
      
      <input type="datetime-local" name="data_agendamento" required 
             min="<?= date('Y-m-d\TH:i') ?>"
             style="width: 100%; padding: 1.2rem 1.5rem; border-radius: 15px; border: 2px solid var(--border); background: rgba(255, 255, 255, 0.07); color: var(--text); font-size: 1.1rem; margin-bottom: 1rem;">
      
      <div style="display: flex; gap: 1rem; justify-content: center;">
        <button type="submit" class="btn btn-primary">Confirmar Agendamento</button>
        <a href="catalogo.php" class="btn btn-outline">Cancelar</a>
      </div>
    </form>
  </div>
</body>
</html>