<?php
require 'db.php';
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? null;
if ($id !== null) {
    if (!ctype_digit((string)$id)) {
        header('Location: admin.php');
        exit;
    }
    $id = (int)$id;
}

if (!$id) {
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        die('Requisição inválida (CSRF).');
    }

    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $imagem = trim($_POST['imagem'] ?? '');
    $disp = isset($_POST['disponivel']) ? 1 : 0;

    if ($titulo === '' || $descricao === '' || $imagem === '') {
        $error = 'todos_campos_obrigatorios';
    } elseif (!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $imagem)) {
        $error = 'Nome de imagem inválido. Use apenas letras, números, hífen, underline e ponto.';
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE carros SET titulo=?, descricao=?, imagem=?, disponivel=? WHERE idcar=?");
            $stmt->execute([$titulo, $descricao, $imagem, $disp, $id]);

            header('Location: admin.php?success=1');
            exit;
        } catch (PDOException $e) {
            $error = "Erro ao atualizar carro: " . $e->getMessage();
        }
    }
}

$stmt = $pdo->prepare("SELECT * FROM carros WHERE idcar=?");
$stmt->execute([$id]);
$c = $stmt->fetch();

if (!$c) {
    header('Location: admin.php');
    exit;
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title data-i18n="editar_carro">Editar Carro - Select Car Motors</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>
  
  <div class="centered">
    <form class="card-form" method="post">
      <h2 data-i18n="editar_carro_h2">Editar Carro</h2>
      
      <?php if (isset($error) && strpos($error, 'todos_campos_obrigatorios') !== false): ?>
          <div style="background: rgba(239,68,68,0.1); color: #ef4444; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(239,68,68,0.3);">
              <span data-i18n="<?= $error ?>">Preencha todos os campos.</span>
          </div>
      <?php elseif (isset($error)): ?>
          <div style="background: rgba(239,68,68,0.1); color: #ef4444; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid rgba(239,68,68,0.3);">
              <?= htmlspecialchars($error) ?>
          </div>
      <?php endif; ?>
      
      <input type="text" name="titulo" value="<?= htmlspecialchars($c['titulo']) ?>" required data-i18n-placeholder="titulo_carro" placeholder="Título">
      <input type="text" name="descricao" value="<?= htmlspecialchars($c['descricao']) ?>" required data-i18n-placeholder="descricao_carro" placeholder="Descrição">
      <input type="text" name="imagem" value="<?= htmlspecialchars($c['imagem']) ?>" required data-i18n-placeholder="imagem_carro" placeholder="Nome do arquivo (ex: car6.jpg)">
      <label style="display:block;margin-top:15px; color: var(--muted); font-weight: 600;">
        <input type="checkbox" name="disponivel" <?= $c['disponivel'] ? 'checked' : '' ?> style="margin-right: 10px;">
        <span data-i18n="disponivel">Disponível</span>
      </label>
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
      
      <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 2rem;">
        <button class="btn btn-primary" type="submit" data-i18n="salvar">Salvar Alterações</button>
        <a href="admin.php" class="btn btn-outline" data-i18n="cancelar">Cancelar</a>
      </div>
    </form>
  </div>

  <script src="lang-switcher.js"></script>
</body>
</html>