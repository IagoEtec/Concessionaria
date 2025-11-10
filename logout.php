<?php
session_start();
    unset(
        $_SESSION['id'],
        $_SESSION['nome'],
        $_SESSION['email']
    );
    header('Location: index.php');

/* O unset() no PHP é uma função que remove uma variável da memória, liberando o espaço que estava ocupando. */


?>