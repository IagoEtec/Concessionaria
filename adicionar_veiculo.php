<?php
// Inclui o cabeçalho que já inicia a sessão
include 'includes/header.php';

// Verifica se usuário é administrador - CORREÇÃO DA VERIFICAÇÃO
if (!isset($_SESSION['id'])) {
    die("Acesso negado. Faça login primeiro.");
}

// DEBUG: Mostrar o tipo de usuário para diagnóstico
error_log("Tipo de usuário na sessão: " . $_SESSION['tipo']);

if ($_SESSION['tipo'] != 'admin') {
    die("Acesso negado. Apenas administradores podem adicionar veículos. Seu tipo: " . $_SESSION['tipo']);
}
?>

<!-- Link para o arquivo CSS específico desta página -->
<link rel="stylesheet" href="assets/css/adicionar_veiculos.css">

<!-- Container principal do formulário -->
<div class="container">
    <h2>Cadastro de Veículo</h2>

    <!-- Formulário para cadastrar novo veículo -->
    <form action="salvar_veiculo.php" method="POST" enctype="multipart/form-data">
        
        <label for="tipo_veiculo">Tipo de Veículo</label>
        <select id="tipo_veiculo" name="tipo_veiculo" required>
            <option value="">Selecione</option>
            <option value="carro">Carro</option>
            <option value="moto">Moto</option>
        </select>

        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" placeholder="Ex: Honda" required>

        <label for="modelo">Modelo</label>
        <input type="text" id="modelo" name="modelo" placeholder="Ex: Civic" required>

        <label for="ano">Ano</label>
        <input type="number" id="ano" name="ano" placeholder="Ex: 2023" min="1900" max="2030" required>

        <label for="imagem">Imagem do Veículo</label>
        <input type="file" id="imagem" name="imagem" accept="image/*" required>

        <button type="submit">Enviar</button>
    </form>

    <a href="home.php" class="btn-voltar">Voltar</a>
</div>

<?php
// Inclui o rodapé da página
include 'includes/footer.php';
?>