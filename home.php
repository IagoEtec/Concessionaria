<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    echo "<script>alert('Você precisa fazer login para acessar esta página!'); window.location.href='login.php';</script>";
    exit;
}
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
    <div class="logo">🚗 AutoDrive</div>
    <nav>
      <a href="logout.php" class="btn-sair">Sair</a>
    </nav>
  </header>

  <main>
    <h1>Veículos Disponíveis para Test Drive</h1>
    <p>Escolha o carro que você deseja testar e agende seu horário!</p>

    <section class="carros-container">
      <!-- Card 1 -->
      <div class="car-card">
        <img src="img/audi.jpg" alt="Audi A4">
        <h2>Audi A4</h2>
        <p>Elegância e desempenho de ponta. Um sedan que une luxo e tecnologia.</p>
        <a href="agendamento.php?carro=Audi A4" class="btn-agendar">Agendar Test Drive</a>
      </div>

      <!-- Card 2 -->
      <div class="car-card">
        <img src="img/bmw.jpg" alt="BMW X5">
        <h2>BMW X5</h2>
        <p>Conforto, potência e design marcante. O SUV ideal para quem exige o melhor.</p>
        <a href="agendamento.php?carro=BMW X5" class="btn-agendar">Agendar Test Drive</a>
      </div>

      <!-- Card 3 -->
      <div class="car-card">
        <img src="img/mercedes.jpg" alt="Mercedes-Benz C180">
        <h2>Mercedes-Benz C180</h2>
        <p>Um ícone de sofisticação e desempenho impecável em cada detalhe.</p>
        <a href="agendamento.php?carro=Mercedes-Benz C180" class="btn-agendar">Agendar Test Drive</a>
      </div>

      <!-- Card 4 -->
      <div class="car-card">
        <img src="img/tesla.jpg" alt="Tesla Model 3">
        <h2>Tesla Model 3</h2>
        <p>Futuro da mobilidade: 100% elétrico, silencioso e incrivelmente potente.</p>
        <a href="agendamento.php?carro=Tesla Model 3" class="btn-agendar">Agendar Test Drive</a>
      </div>
    </section>
  </main>

  <footer>
    <p>© 2025 AutoDrive. Todos os direitos reservados.</p>
  </footer>

</body>
</html>
