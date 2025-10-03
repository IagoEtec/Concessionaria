<?php
// index.php (ATUALIZADO)
session_start();
require 'config.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<title data-i18n="inicio">Select Car Motors</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>
  
  <section class="hero">
    <div class="hero-left">
      <small data-i18n="select_car_motors">SELECT CAR MOTORS</small>
      <h1><span class="accent" data-i18n="bem_vindo">BEM VINDO</span> <span data-i18n="bem_vindo_site">AO NOSSO SITE</span></h1>
      <p class="sub" data-i18n="subtitulo_home">Encontre carros esportivos e exclusivos — confira nosso catálogo.</p>

      <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="login.php" class="btn btn-primary" data-i18n="fazer_login">Fazer login</a>
        <a href="register.php" class="btn btn-outline" data-i18n="nao_possui_cadastro">Não possui cadastro? Cadastrar</a>
      <?php else: ?>
        <a href="catalogo.php" class="btn btn-primary" data-i18n="ver_catalogo">Ver Catálogo</a>
        <a href="admin.php" class="btn btn-outline" data-i18n="area_administrativa">Área Administrativa</a>
      <?php endif; ?>
    </div>

    <div class="hero-right">
      <img src="img/Ford mustang (1) (1).jpg" alt="Ford Mustang">
    </div>
  </section>
  
  <footer>
    <p data-i18n="isaias_42_8">"Eu sou o Senhor; este é o meu nome! Não darei a outro a minha glória nem a imagens o meu louvor."</p>
    <p data-i18n="isaias">Isaías 42:8</p>
  </footer>

  <script src="lang-switcher.js"></script>
</body>
</html>