<?php
// index.php (ATUALIZADO - SEM IDIOMAS)
session_start();
require 'config.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<title>Select Car Motors</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>
  
  <section class="hero">
    <div class="hero-left">
      <small>SELECT CAR MOTORS</small>
      <h1><span class="accent">BEM VINDO</span> <span>AO NOSSO SITE</span></h1>
      <p class="sub">Encontre carros esportivos e exclusivos — confira nosso catálogo.</p>

      <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="login.php" class="btn btn-primary">Fazer login</a>
        <a href="register.php" class="btn btn-outline">Não possui cadastro? Cadastrar</a>
      <?php else: ?>
        <a href="catalogo.php" class="btn btn-primary">Ver Catálogo</a>
        <a href="admin.php" class="btn btn-outline">Área Administrativa</a>
      <?php endif; ?>
    </div>

    <div class="hero-right">
      <img src="img/Ford mustang (1) (1).jpg" alt="Ford Mustang">
    </div>
  </section>
  
  <footer>
    <p>"Eu sou o Senhor; este é o meu nome! Não darei a outro a minha glória nem a imagens o meu louvor."</p>
    <p>Isaías 42:8</p>
  </footer>
</body>
</html>