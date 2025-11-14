<?php
session_start();

include_once 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$consulta = "SELECT * FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($consulta);
$stmt->bindParam(':email', $email);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado && password_verify($senha, $resultado['senha'])) {

    $_SESSION['id']    = $resultado['id'];
    $_SESSION['nome']  = $resultado['nome'];
    $_SESSION['email'] = $resultado['email'];
    $_SESSION['tipo']  = $resultado['tipo_conta']; // CONFIRA SE ESSE NOME EXISTE NO BANCO

    header("Location: home.php");
    exit;

} else {
    echo "<script>alert('E-mail ou senha incorretos!'); window.history.back();</script>";
    exit;
}
?>
