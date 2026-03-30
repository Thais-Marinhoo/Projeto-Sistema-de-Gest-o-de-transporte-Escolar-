<?php
session_start();
include('conexao.php');

//Isso aqui faz voltar caso n esteja preenchido
if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: index.php');
    exit();
}

//cria uma var e atribui a email e senha
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

//Pesquisa no QUERY se o que foi digitado realmente existe, Result é o resultado da QUERY
$query = "SELECT id_usuario, login FROM users WHERE login = '$email' AND senha = MD5('$senha')";
$result = mysqli_query($conexao, $query);

//Auto explicativo
if (!$result) {
    die("Erro na consulta: " . mysqli_error($conexao));
}


$row = mysqli_num_rows($result);

if ($row == 1) {
    $_SESSION['email'] = $email;
    header('Location: painel.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php?status=mistake');
    exit();
}
?>