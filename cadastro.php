

<!-- Link para o arquivo CSS específico desta página -->
<link rel="stylesheet" href="assets/css/cadastro.css">

<!-- Container principal do formulário de cadastro -->
<div class="cadastro-container">
    <h1>Criar Conta</h1>
    
    <!-- Formulário de cadastro que envia dados para salvar_cadastro.php -->
    <form action="salvar_cadastro.php" method="POST">
        <!-- Campo para nome completo do usuário -->
        <input type="text" name="nome" placeholder="Nome completo" required>
        <!-- Campo para email com validação nativa do tipo email -->
        <input type="email" name="email" placeholder="E-mail" required>
        <!-- Campo para senha que oculta os caracteres digitados -->
        <input type="password" name="senha" placeholder="Senha" required>

        <!-- Select para escolher o tipo de conta -->
        <select name="tipo_conta" required>
            <option value="">Selecione o tipo de conta</option>
            <option value="cliente">Cliente</option>
            <option value="admin">Administrador</option> 
        </select>

        <!-- Botão para submeter o formulário de cadastro -->
        <button type="submit">Cadastrar</button>
    </form>

    <!-- Link para página de login para usuários já cadastrados -->
    <p class="login-link">
        Já tem uma conta? <a href="login.php">Faça login</a>
    </p>

    <!-- Link para voltar à página inicial -->
    <a href="index.php" class="btn-voltar">⬅ Voltar ao Início</a>
</div>
