<?php
session_start();

if (!isset($_SESSION['tipo'])) {
    echo "<script>alert('Erro: tipo de usuário não definido. Faça login novamente.'); window.location.href='login.php';</script>";
    exit;
}


// Verifica se o usuário está logado
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    echo "<script>alert('Você precisa fazer login para acessar esta página!'); window.location.href='login.php';</script>";
    exit;
}

// Verifica o tipo do usuário
$tipo_usuario = $_SESSION['tipo']; // 'cliente' ou 'admin'
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Veículos Disponíveis - AutoDrive</title>
  <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

  <header>
    <div class="logo">AutoDrive</div>
    <nav>

      <?php if ($tipo_usuario === 'admin'): ?>
        <a href="adicionar.php" class="btn-admin">Adicionar Carro</a>
      <?php endif; ?>

      <a href="logout.php" class="btn-sair">Sair</a>
    </nav>
  </header>

  <main>
    <h1>Veículos Disponíveis</h1>
    <p>Escolha um carro para testar.</p>

    <section class="carros-container">
      
      <!-- CARD DO CARRO - EXEMPLO -->
      <div class="car-card">
        <img src="img/audi.jpg" alt="Audi A4">
        <h2>Audi A4</h2>
        <p>Elegância e desempenho de ponta. Um sedan com tecnologia avançada.</p>

        <?php if ($tipo_usuario === 'cliente'): ?>
            <a href="agendamento.php?carro=Audi A4" class="btn-agendar">Agendar Test Drive</a>
        <?php else: ?>
            <a href="editar_veiculo.php?id=1" class="btn-editar">Editar</a>
            <a href="excluir_carro.php?id=1" class="btn-excluir" onclick="return confirm('Deseja excluir este carro?')">Excluir</a>
        <?php endif; ?>
      </div>

      <!-- COPIE ESSE BLOCO PARA OUTROS CARROS -->
      <div class="car-card">
        <img src="img/bmw.jpg" alt="BMW X5">
        <h2>BMW X5</h2>
        <p>Conforto e potência com design marcante.</p>

        <?php if ($tipo_usuario === 'cliente'): ?>
            <a href="agendamento.php?carro=BMW X5" class="btn-agendar">Agendar Test Drive</a>
        <?php else: ?>
            <a href="editar_carro.php?id=2" class="btn-editar">Editar</a>
            <a href="excluir_carro.php?id=2" class="btn-excluir" onclick="return confirm('Deseja excluir este carro?')">Excluir</a>
        <?php endif; ?>
      </div>

      <div class="car-card">
        <img src="img/mercedes.jpg" alt="Mercedes C180">
        <h2>Mercedes-Benz C180</h2>
        <p>Sofisticação e desempenho impecável em cada detalhe.</p>

        <?php if ($tipo_usuario === 'cliente'): ?>
            <a href="agendamento.php?carro=Mercedes-Benz C180" class="btn-agendar">Agendar Test Drive</a>
        <?php else: ?>
            <a href="editar_carro.php?id=3" class="btn-editar">Editar</a>
            <a href="excluir_carro.php?id=3" class="btn-excluir" onclick="return confirm('Deseja excluir este carro?')">Excluir</a>
        <?php endif; ?>
      </div>

      <div class="car-card">
        <img src="img/tesla.jpg" alt="Tesla Model 3">
        <h2>Tesla Model 3</h2>
        <p>Carro 100% elétrico, silencioso e extremamente potente.</p>

        <?php if ($tipo_usuario === 'cliente'): ?>
            <a href="agendamento.php?carro=Tesla Model 3" class="btn-agendar">Agendar Test Drive</a>
        <?php else: ?>
            <a href="editar_carro.php?id=4" class="btn-editar">Editar</a>
            <a href="excluir_carro.php?id=4" class="btn-excluir" onclick="return confirm('Deseja excluir este carro?')">Excluir</a>
        <?php endif; ?>
      </div>

    </section>
  </main>

  <footer>
    <p>© 2025 AutoDrive. Todos os direitos reservados.</p>
  </footer>

</body>
</html>
