<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro - AutoDrive</title>
  <link rel="stylesheet" href="assets/css/cadastro.css">
</head>
<body>
  <div class="cadastro-container">
    <h1>Criar Conta</h1>

    <form action="salvar_cadastro.php" method="POST">
      <input type="text" name="nome" placeholder="Nome completo" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>


<!--Essa linha de código cria um menu suspenso (dropdown) em um formulário HTML.-->
      <select name="tipo_conta" required>
        <option value="">Selecione o tipo de conta</option>
        <option value="cliente">Cliente</option>
        <option value="admin">Administrador</option>
      </select>

      <button type="submit">Cadastrar</button>
    </form>

    <p class="login-link">
      Já tem uma conta? <a href="login.php">Faça login</a>
    </p>

    <a href="index.php" class="btn-voltar">⬅ Voltar ao Início</a>
  </div>
</body>
</html>
