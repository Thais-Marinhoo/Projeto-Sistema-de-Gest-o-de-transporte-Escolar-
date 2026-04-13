<?php
session_start();
include 'conexao.php';

$id = $_GET['id_usuario'];

//Ajuda do gepeto
# RECEBE CAMPOS
$name = $_POST['name'];
$login = $_POST['login'];

# ATUALIZA NO BANCO
$sql = "UPDATE users SET 
    login = '$login',
    senha = '$senha' 
    WHERE id_aluno = $id";

mysqli_query($conexao, $sql);

header("Location: telaadmin.php");
exit();