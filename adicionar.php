<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Veículos</title>
    <link rel="stylesheet" href="assets/css/adicionar.css">
</head>
<body>

    <div class="container">
        <h2>Cadastro de Veículo</h2>

        <!-- enctype é necessário para upload de imagem -->
        <form action="#" method="POST" enctype="multipart/form-data">

            <label for="tipo_veiculo">Tipo de Veículo</label>
            <select id="tipo_veiculo" name="tipo_veiculo" required>
                <option value="">Selecione</option>
                <option value="carro">Carro</option>
                <option value="moto">Moto</option>
            </select>

            <label for="modelo">Modelo</label>
            <input type="text" id="modelo" name="modelo" placeholder="Ex: Honda Civic" required>

            <label for="imagem">Imagem do Veículo</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required>

            <label for="descricao">Descrição do Veículo</label>
            <textarea id="descricao" name="descricao" rows="4" placeholder="Digite uma descrição detalhada..." required></textarea>

            <button type="submit">Enviar</button>
        </form>

        <!-- Botão Voltar -->
        <a href="home.php" class="btn-voltar">Voltar</a>
    </div>

</body>
</html>
