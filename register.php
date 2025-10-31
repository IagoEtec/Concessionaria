<?php
require 'db.php';
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $nome_user = trim($_POST['nome_user']);
    $password = password_hash($_POST['senha'], PASSWORD_BCRYPT);
    $tipo = $_POST['tipo'] ?? 'cliente';

    // Validações
    if (empty($username) || empty($email) || empty($nome_user) || empty($_POST['senha'])) {
        $error = "Todos os campos são obrigatórios.";
    } elseif (strlen($_POST['senha']) < 6) {
        $error = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO login (username, email, senha, tipo) VALUES (?, ?, ?, ?)");
            
            if ($stmt->execute([$username, $email, $password, $tipo])) {
                $last_id = $pdo->lastInsertId();
                $stmt2 = $pdo->prepare("INSERT INTO perfil_user (idlog, nome_user) VALUES (?, ?)");
                $stmt2->execute([$last_id, $nome_user]);
                
                header("Location: login.php?success=1");
                exit;
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "Usuário ou e-mail já cadastrado.";
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
    <title>Cadastro - Select Car Motors</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>
  
  <div class="centered">
    <form class="card-form" method="post">
      <h2>Cadastro</h2>
      
      <?php if (isset($error)): ?>
          <div style="background: rgba(239,68,68,0.1); color: #ef4444; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(239,68,68,0.3);">
              <?= htmlspecialchars($error) ?>
          </div>
      <?php endif; ?>
      
      <?php if (isset($_GET['success'])): ?>
          <div style="background: rgba(16,185,129,0.1); color: #10b981; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(16,185,129,0.3);">
              Cadastro realizado com sucesso! Faça login.
          </div>
      <?php endif; ?>
      
      <input type="text" name="username" placeholder="Usuário" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
      <input type="email" name="email" placeholder="E-mail" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      <input type="text" name="nome_user" placeholder="Nome completo" required value="<?= htmlspecialchars($_POST['nome_user'] ?? '') ?>">
      <input type="password" name="senha" placeholder="Senha (mínimo 6 caracteres)" required minlength="6">
      
      <!-- Novo campo: tipo de usuário -->
      <div style="margin-bottom: 1rem;">
        <label style="color: var(--text); font-weight: 600; display: block; margin-bottom: 0.5rem;">Tipo de Conta</label>
        <select name="tipo" style="width: 100%; padding: 1.2rem 1.5rem; border-radius: 15px; border: 2px solid var(--border); background: rgba(255, 255, 255, 0.07); color: var(--text); font-size: 1.1rem;">
          <option value="cliente">Cliente</option>
          <option value="atendente">Atendente</option>
        </select>
      </div>
      
      <button class="btn btn-primary" type="submit">Cadastrar</button>
      <p><a href="login.php">Já tem conta? Entrar</a></p>
    </form>
  </div>
</body>
</html>