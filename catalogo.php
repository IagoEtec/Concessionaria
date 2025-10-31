<?php
// catalogo.php (ATUALIZADO - SEM IDIOMAS)
require 'db.php';
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Verificar tipo de usuário
$stmt = $pdo->prepare("SELECT tipo FROM login WHERE idlog = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
$is_cliente = $user['tipo'] === 'cliente';

$stmt = $pdo->query("SELECT * FROM carros WHERE disponivel = 1 ORDER BY idcar DESC");
$carros = $stmt->fetchAll();
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<title>Catálogo - Select Car Motors</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>

<main class="container">
  <h2>Carros Disponíveis</h2>
  
  <?php if (isset($_GET['success']) && $_GET['success'] == 'agendamento'): ?>
      <div style="background: rgba(16,185,129,0.1); color: #10b981; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(16,185,129,0.3);">
          Test drive solicitado com sucesso! Aguarde a aprovação.
      </div>
  <?php endif; ?>
  
  <?php if (empty($carros)): ?>
    <div style="text-align: center; padding: 3rem; color: var(--muted);">
      <p>Nenhum carro disponível no momento.</p>
    </div>
  <?php else: ?>
    <div class="cards">
      <?php foreach($carros as $c): ?>
      <div class="card">
        <img src="img/<?= htmlspecialchars($c['imagem']) ?>" alt="<?= htmlspecialchars($c['titulo']) ?>" 
             onerror="this.src='https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'">
        <h3><?= htmlspecialchars($c['titulo']) ?></h3>
        <p><?= htmlspecialchars($c['descricao']) ?></p>
        <div class="card-details">
          <div class="teste-drive-disponivel <?= $c['disponivel_test_drive'] ? 'verde' : 'vermelho' ?>">
            <?= $c['disponivel_test_drive'] ? 'Disponível para teste drive' : 'Indisponível para teste drive' ?>
          </div>
          
          <?php if ($is_cliente && $c['disponivel_test_drive']): ?>
            <div style="margin-top: 1rem;">
              <a href="agendar_test_drive.php?id=<?= $c['idcar'] ?>" class="btn-small edit">Agendar Test Drive</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>

<footer>
  <p>"Eu sou o Senhor; este é o meu nome! Não darei a outro a minha glória nem a imagens o meu louvor."</p>
  <p>Isaías 42:8</p>
</footer>
</body>
</html>