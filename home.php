<?php
// Inclui o cabeçalho que já inicia a sessão
include 'includes/header.php';

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Verifica se o usuário está logado (se existe ID na sessão)
if (!isset($_SESSION['id'])) {
    // Se não estiver logado, redireciona para página de login
    header("Location: login.php");
    exit;
}

// Armazena o tipo de usuário (cliente ou admin) para controle de acesso
$tipo_usuario = $_SESSION['tipo'];

// Buscar veículos no banco de dados
$sql = "SELECT * FROM veiculos ORDER BY id DESC";
$stmt = $pdo->query($sql);
$veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Link para o arquivo CSS específico desta página -->
<link rel="stylesheet" href="assets/css/home.css">

<!-- Tag main para o conteúdo principal -->
<main>
    <!-- Seção banner com título e descrição -->
    <section class="banner">
        <div class="container">
            <h1>Escolha seu próximo Test Drive</h1>
            <p>Os melhores veículos selecionados especialmente para você.</p>
        </div>
    </section>

    <!-- Conteúdo principal da página -->
    <div class="container">
        <h2 class="titulo-home">Veículos Disponíveis</h2>

        <!-- Container dos cards de veículos -->
        <div class="carros-container">

        <?php foreach ($veiculos as $v): ?> 
            <!-- Início do loop que gera um card para cada veículo -->
            <div class="car-card">

                <!-- Imagem do veículo -->
                <img src="uploads/<?php echo $v['imagem']; ?>" alt="<?php echo $v['modelo']; ?>">

                <!-- Informações do veículo -->
                <div class="info-veiculo">
                    <h3><?php echo $v['modelo']; ?></h3>
                    <p class="marca"><strong>Marca:</strong> <?php echo $v['marca']; ?></p>
                    <p class="ano"><strong>Ano:</strong> <?php echo $v['ano']; ?></p>
                    <p class="tipo"><strong>Tipo:</strong> <?php echo ucfirst($v['tipo']); ?></p>
                </div>

                <!-- Botão de disponibilidade do veículo -->
                <div class="status-veiculo">
                    <?php if ($v['disponivel'] == 1): ?>
                        <!-- Veículo disponível - botão verde -->
                        <button class="btn-disponivel">
                            Disponível
                        </button>
                    <?php else: ?>
                        <!-- Veículo indisponível - botão vermelho -->
                        <button class="btn-indisponivel">
                            Indisponível
                        </button>
                    <?php endif; ?>
                </div>

                <!-- Área de ações (botões) do card -->
                <div class="acoes-card">

                <?php if ($tipo_usuario === 'cliente'): ?>
                    <!-- Ações para clientes -->

                    <?php if ($v['disponivel'] == 1): ?>
                        <!-- Se veículo disponível, mostra botão para agendar -->
                        <a href="agendamento.php?id=<?php echo $v['id']; ?>" class="btn-agendar">
                            Agendar Test Drive
                        </a>
                    <?php else: ?>
                        <!-- Se veículo indisponível, mostra botão desabilitado -->
                        <button class="btn-desabilitado" disabled>
                            Indisponível para agendar
                        </button>
                    <?php endif; ?>

                <?php else: ?>
                    <!-- Ações para administradores -->

                    <!-- Botão para editar veículo -->
                    <a href="editar_veiculo.php?id=<?php echo $v['id']; ?>" class="btn-editar">Editar</a>

                    <!-- Botão para excluir veículo com confirmação JavaScript -->
                    <a href="apagar_veiculo.php?id=<?php echo $v['id']; ?>" class="btn-excluir"
                        onclick="return confirm('Confirmar exclusão?')">
                        Excluir
                    </a>

                <?php endif; ?>

                </div>

            </div>
            <!-- Fim do card do veículo -->
        <?php endforeach; ?>

        </div>
        <!-- Fim do container de veículos -->
    </div>
</main>

<?php
// Inclui o rodapé da página
include 'includes/footer.php';
?>