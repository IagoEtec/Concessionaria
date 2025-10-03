<?php
// catalogo.php (ATUALIZADO)
require 'db.php';
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM carros WHERE disponivel = 1 ORDER BY idcar DESC");
$carros = $stmt->fetchAll();
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<title data-i18n="catalogo">Catálogo - Select Car Motors</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>

<main class="container">
  <h2 data-i18n="carros_disponiveis">Carros Disponíveis</h2>
  
  <?php if (empty($carros)): ?>
    <div style="text-align: center; padding: 3rem; color: var(--muted);">
      <p data-i18n="nenhum_carro_disponivel">Nenhum carro disponível no momento.</p>
    </div>
  <?php else: ?>
    <div class="cards">
      <?php foreach($carros as $c): ?>
      <div class="card">
        <img src="img/<?= htmlspecialchars($c['imagem']) ?>" alt="<?= htmlspecialchars($c['titulo']) ?>" 
             onerror="this.src='https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'">
        <h3 data-original-title="<?= htmlspecialchars($c['titulo']) ?>"><?= htmlspecialchars($c['titulo']) ?></h3>
        <p data-original-desc="<?= htmlspecialchars($c['descricao']) ?>"><?= htmlspecialchars($c['descricao']) ?></p>
        <div class="card-details">
          <div class="teste-drive-disponivel <?= $c['disponivel'] ? 'verde' : 'vermelho' ?>">
            <?= $c['disponivel'] ? 'Disponível para teste drive' : 'Indisponível para teste drive' ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>

<footer>
  <p data-i18n="isaias_42_8">"Eu sou o Senhor; este é o meu nome! Não darei a outro a minha glória nem a imagens o meu louvor."</p>
  <p data-i18n="isaias">Isaías 42:8</p>
</footer>

<script src="lang-switcher.js"></script>
</body>
</html>