<?php
// Arquivo de conexão com o banco de dados MySQL usando PDO
// Este arquivo estabelece a comunicação entre o PHP e o banco de dados

// Configurações de acesso ao banco de dados
$host = 'localhost';      // Endereço do servidor do banco de dados (local)
$dbname = 'concessionaria'; // Nome do banco de dados que será utilizado
$user = 'root';           // Usuário do banco de dados (padrão do XAMPP)
$pass = '';               // Senha do banco de dados (vazia no XAMPP padrão)

// Bloco try-catch para tratamento de erros na conexão
try {
    // Cria uma nova instância PDO para conexão com MySQL
    // PDO (PHP Data Objects) é uma interface para acesso a bancos de dados
    // DSN (Data Source Name): string de conexão com formato "mysql:host=...;dbname=..."
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    
    // Configura o PDO para lançar exceções em caso de erro
    // Isso facilita o debug e tratamento de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Captura e exibe qualquer erro que ocorrer durante a conexão
    // PDOException é a classe específica para erros do PDO
    echo "Erro na conexão: " . $e->getMessage();
    // getMessage() retorna a mensagem de erro descritiva
}
?>