<?php 
// Verifica se existe um parâmetro 'erro' na URL (usado para mensagens de login falho)
if(isset($_GET['erro'])): ?>
  <!-- Exibe um alerta JavaScript se houver erro de login -->
  <script>alert('Login ou senha incorreto');</script>
<?php endif; ?>

<?php
// Inclui o cabeçalho da página
include 'includes/header.php';
?>

<!-- Link para o arquivo CSS específico desta página -->
<link rel="stylesheet" href="assets/css/index.css">

<!-- Seção hero (principal) com chamada para ação -->
<section class="hero">
    <div class="hero-content">
        <!-- Título principal da página -->
        <h1>Experimente a emoção de dirigir o carro dos seus sonhos!</h1>
        <!-- Subtítulo descritivo -->
        <p>Agende seu test drive com facilidade e descubra o prazer de estar no controle.</p>
        <!-- Botão call-to-action que leva para o login -->
        <a href="login.php" class="btn">Agendar Test Drive</a>
    </div>
</section>

<!-- Seção "Sobre" da empresa -->
<section id="sobre" class="sobre">
    <h2>Sobre a AutoDrive</h2>
    <!-- Texto institucional da empresa -->
    <p>
        A <strong>AutoDrive</strong> oferece uma experiência moderna e prática para agendar test drives.
        Explore diversos modelos, escolha o que combina com você e venha sentir a diferença.
    </p>

    <!-- Container dos cards de benefícios -->
    <div class="cards">
        <!-- Card 1: Modelos Exclusivos -->
        <div class="card">
            <img src="assets/img/carro1.webp" alt="Carro esportivo">
            <h3>Modelos Exclusivos</h3>
            <p>Escolha entre os carros mais desejados do mercado.</p>
        </div>

        <!-- Card 2: Experiência Única -->
        <div class="card">
            <img src="assets/img/interior.jpeg" alt="Interior de carro">
            <h3>Experiência Única</h3>
            <p>Teste antes de decidir, sinta o desempenho e conforto.</p>
        </div>

        <!-- Card 3: Agendamento Simples -->
        <div class="card">
            <img src="assets/img/bmw.jpg" alt="BMW preta">
            <h3>Agendamento Simples</h3>
            <p>Faça tudo online em poucos cliques.</p>
        </div>
    </div>
</section>

<?php
// Inclui o rodapé da página
include 'includes/footer.php';
?>