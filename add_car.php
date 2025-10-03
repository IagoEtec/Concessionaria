<?php
require 'db.php';
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF protection
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        die('Requisição inválida (CSRF).');
    }

    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $imagem = trim($_POST['imagem'] ?? '');
    $disponivel = isset($_POST['disponivel']) ? 1 : 0;

    // Validações
    if (empty($titulo) || empty($descricao) || empty($imagem)) {
        $error = "todos_campos_obrigatorios";
    } elseif (!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $imagem)) {
        $error = "Nome de imagem inválido. Use apenas letras, números, hífen, underline e ponto.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO carros (titulo, descricao, imagem, disponivel) VALUES (?, ?, ?, ?)");
            $stmt->execute([$titulo, $descricao, $imagem, $disponivel]);
            
            header('Location: admin.php?success=1');
            exit;
        } catch (PDOException $e) {
            $error = "Erro ao adicionar carro: " . $e->getMessage();
        }
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title data-i18n="adicionar_carro">Adicionar Carro - Select Car Motors</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>
  
  <div class="centered">
    <form class="card-form" method="post">
      <h2 data-i18n="adicionar_carro">Adicionar Novo Carro</h2>
      
      <?php if (isset($error) && strpos($error, 'todos_campos_obrigatorios') !== false): ?>
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
              <span data-i18n="carro_adicionado_sucesso">Carro adicionado com sucesso!</span>
          </div>
      <?php endif; ?>
      
      <div class="form-grid">
          <input type="text" name="titulo" data-i18n-placeholder="titulo_carro" placeholder="Título do carro" required value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>">
          <input type="text" name="descricao" data-i18n-placeholder="descricao_carro" placeholder="Descrição do carro" required value="<?= htmlspecialchars($_POST['descricao'] ?? '') ?>">
      </div>
      
      <div class="image-checkbox-wrapper">
          <div class="input-wrapper">
              <input type="text" name="imagem" data-i18n-placeholder="imagem_carro" placeholder="Nome da imagem (ex: car6.jpg)" required value="<?= htmlspecialchars($_POST['imagem'] ?? '') ?>">
          </div>
          <div class="checkbox-container">
              <input type="checkbox" name="disponivel" value="1" id="disponivel" <?= isset($_POST['disponivel']) ? 'checked' : 'checked' ?>>
              <label for="disponivel" data-i18n="disponivel">Disponível</label>
          </div>
      </div>
      
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
      
      <div class="form-actions">
          <button type="submit" class="btn btn-primary" data-i18n="adicionar">Adicionar Carro</button>
          <a href="admin.php" class="btn btn-outline" data-i18n="cancelar">Cancelar</a>
      </div>
    </form>
  </div>

  <script src="lang-switcher.js"></script>
</body>
</html>