<?php
require 'db.php';
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $nome_user = trim($_POST['nome_user']);
    $password = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    // Validações
    if (empty($username) || empty($email) || empty($nome_user) || empty($_POST['senha'])) {
        $error = "todos_campos_obrigatorios";
    } elseif (strlen($_POST['senha']) < 6) {
        $error = "senha_minimo_caracteres";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO login (username, email, senha) VALUES (?, ?, ?)");
            
            if ($stmt->execute([$username, $email, $password])) {
                $last_id = $pdo->lastInsertId();
                $stmt2 = $pdo->prepare("INSERT INTO perfil_user (idlog, nome_user) VALUES (?, ?)");
                $stmt2->execute([$last_id, $nome_user]);
                
                header("Location: login.php?success=1");
                exit;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "usuario_email_cadastrado";
            } else {
                $error = "Erro ao registrar usuário: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title data-i18n="cadastrar">Cadastro - Select Car Motors</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>
  
  <div class="centered">
    <form class="card-form" method="post">
      <h2 data-i18n="cadastrar">Cadastro</h2>
      
      <?php if (isset($error) && strpos($error, 'Erro ao registrar') === false): ?>
          <div style="background: rgba(239,68,68,0.1); color: #ef4444; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(239,68,68,0.3);">
              <span data-i18n="<?= $error ?>">Todos os campos são obrigatórios.</span>
          </div>
      <?php elseif (isset($error)): ?>
          <div style="background: rgba(239,68,68,0.1); color: #ef4444; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(239,68,68,0.3);">
              <?= htmlspecialchars($error) ?>
          </div>
      <?php endif; ?>
      
      <?php if (isset($_GET['success'])): ?>
          <div style="background: rgba(16,185,129,0.1); color: #10b981; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(16,185,129,0.3);">
              <span data-i18n="cadastro_realizado_sucesso">Cadastro realizado com sucesso! Faça login.</span>
          </div>
      <?php endif; ?>
      
      <input type="text" name="username" data-i18n-placeholder="placeholder_usuario" placeholder="Usuário" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
      <input type="email" name="email" data-i18n-placeholder="placeholder_email" placeholder="E-mail" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      <input type="text" name="nome_user" data-i18n-placeholder="placeholder_nome_completo" placeholder="Nome completo" required value="<?= htmlspecialchars($_POST['nome_user'] ?? '') ?>">
      <input type="password" name="senha" data-i18n-placeholder="placeholder_senha_minimo" placeholder="Senha (mínimo 6 caracteres)" required minlength="6">
      <button class="btn btn-primary" type="submit" data-i18n="cadastrar">Cadastrar</button>
      <p><a href="login.php" data-i18n="ja_tem_conta">Já tem conta? Entrar</a></p>
    </form>
  </div>

  <script src="lang-switcher.js"></script>
</body>
</html>