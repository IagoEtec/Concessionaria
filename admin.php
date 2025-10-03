<?php
// admin.php (ATUALIZADO)
require 'db.php';
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM carros ORDER BY idcar DESC");
$carros = $stmt->fetchAll();
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<title data-i18n="area_admin">Admin - Select Car Motors</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php echo getWallpaperStyle(); ?>
</head>
<body>
  <?php include 'navigation.php'; ?>

<main class="container">
  <h2 data-i18n="area_admin">Área Administrativa</h2>
  
  <div class="admin-form-container">
    <form action="add_car.php" method="post" class="admin-form">
      <h3 data-i18n="adicionar_novo">Adicionar Novo Carro</h3>
      <div class="form-grid">
        <input type="text" name="titulo" placeholder="Título do carro" required data-i18n-placeholder="titulo_carro">
        <input type="text" name="descricao" placeholder="Descrição do carro" required data-i18n-placeholder="descricao_carro">
        <input type="text" name="imagem" placeholder="Nome da imagem (ex: car6.jpg)" required data-i18n-placeholder="imagem_carro">
      </div>
      
      <div class="checkbox-group">
        <input type="checkbox" name="disponivel" value="1" checked id="disponivel">
        <label for="disponivel" data-i18n="disponivel">Disponível</label>
      </div>
      
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
      
      <div class="form-actions">
        <button type="submit" class="btn btn-primary" data-i18n="adicionar">Adicionar Carro</button>
      </div>
    </form>
  </div>

  <hr class="styled-hr">

  <h2 data-i18n="lista_carros">Lista de Carros</h2>
  
  <?php if (empty($carros)): ?>
    <div style="text-align: center; padding: 3rem; color: var(--muted);">
      <p data-i18n="nenhum_carro">Nenhum carro cadastrado.</p>
    </div>
  <?php else: ?>
    <div style="overflow-x: auto;">
      <table>
        <thead>
          <tr>
            <th data-i18n="id">ID</th>
            <th data-i18n="titulo">Título</th>
            <th data-i18n="descricao">Descrição</th>
            <th data-i18n="imagem">Imagem</th>
            <th data-i18n="disponivel">Disponível</th>
            <th data-i18n="acoes">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($carros as $c): ?>
            <tr>
              <td><?= htmlspecialchars($c['idcar']) ?></td>
              <td><?= htmlspecialchars($c['titulo']) ?></td>
              <td style="max-width: 300px; word-wrap: break-word;"><?= htmlspecialchars($c['descricao']) ?></td>
              <td><?= htmlspecialchars($c['imagem']) ?></td>
              <td>
                <span class="status-disponivel <?= $c['disponivel'] ? 'status-sim' : 'status-nao' ?>">
                  <?= $c['disponivel'] ? 'Sim' : 'Não' ?>
                </span>
              </td>
              <td style="white-space: nowrap;">
                <a href="edit_car.php?id=<?= $c['idcar'] ?>" class="btn-small edit" data-i18n="editar">Editar</a>

                <!-- Deletar via POST (form) para evitar GET deletions -->
                <form action="delete_car.php" method="post" style="display:inline" onsubmit="return confirm('Tem certeza que deseja excluir este carro?')">
                  <input type="hidden" name="id" value="<?= $c['idcar'] ?>">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                  <button type="submit" class="btn-small delete" data-i18n="excluir">Excluir</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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