<?php
require 'db.php';
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM login WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['senha'])) {
        $_SESSION['user_id'] = $user['idlog'];
        $_SESSION['username'] = $user['username'];
        header("Location: catalogo.php");
        exit;
    } else {
        $error = "usuario_senha_invalidos";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title data-i18n="fazer_login">Login - Select Car Motors</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>
  
  <div class="centered">
    <form class="card-form" method="post">
      <h2 data-i18n="fazer_login">Fazer login</h2>
      
      <?php if (isset($error)): ?>
          <div style="background: rgba(239,68,68,0.1); color: #ef4444; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(239,68,68,0.3);">
              <span data-i18n="<?= $error ?>">Usuário ou senha inválidos!</span>
          </div>
      <?php endif; ?>
      
      <input type="text" name="username" data-i18n-placeholder="placeholder_usuario" placeholder="Usuário" required>
      <input type="password" name="senha" data-i18n-placeholder="placeholder_senha" placeholder="Senha" required>
      <button class="btn btn-primary" type="submit" data-i18n="entrar">Entrar</button>
      <p><a href="register.php" data-i18n="nao_possui_cadastro">Não possui cadastro? Criar conta</a></p>
    </form>
  </div>

  <script src="lang-switcher.js"></script>
</body>
</html>