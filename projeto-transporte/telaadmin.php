<?php
include "telaadminback.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contas - Tela do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<style>
body{
    margin:0;
    height:100vh;
    background:#0b1f3a;
    display:flex;
    flex-direction:column;
    font-family: Arial, Helvetica, sans-serif;
    color:white;
}

.modal-fake {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: none; /* Escondido por padrão */
    align-items: center;
    justify-content: center;
    z-index: 999;
}

/* Quando o ID do modal for o "alvo" da URL, ele aparece */
.modal-fake:target {
    display: flex;
}

/* Ajuste do botão fechar no topo */
.btn-fechar {
    float: right;
    color: white;
    text-decoration: none;
    font-size: 20px;
}

.container-login{
    flex:1;
    display:flex;
    align-items:center;
    justify-content:center;
}

.card-login{
    width:420px;
    background:#0f2b52;
    border-radius:18px;
    padding:35px;
    box-shadow:0 0 30px rgba(0,0,0,0.4);
}

.logo{
    display:block;
    margin:0 auto 25px auto;
    width:220px;
}

label{
    margin-top:12px;
    margin-bottom:6px;
    font-size:16px;
}

input{
    width:100%;
    height:45px;
    border-radius:10px;
    border:1px solid #3a5a86;
    background:#0b2344;
    color:white;
    padding-left:10px;
    outline:none;
}

.btn-login{
    width:100%;
    margin-top:20px;
    height:48px;
    border:none;
    border-radius:10px;
    background:#f2c230;
    color:#0b1f3a;
    font-size:20px;
    font-weight:700;
}

.esqueceu{
    text-align:center;
    margin-top:12px;
    font-size:14px;
}

.esqueceu a{
    color:#4fc3ff;
    text-decoration:none;
    font-weight:600;
}
</style>
</head>
<body>
    
     <div class="container mt-4">

        <h2 class="mt-4">Contas Cadastradas:</h2>

        <!-- TABELA RESPONSIVA -->
        <div class="table-responsive mt-3">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Senha</th>
                        <th>Opções</th>
                    </tr>
                </thead>

                <tbody>
                    

                    <?php foreach ($lista_contas as $conta): ?>
                    <tr>
                        <td><?= $conta['login']; ?></td>
                        <td><?= $conta['senha']; ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm"
                               href="editar.php?id_usuario=<?= $conta['id_usuario']; ?>">
                                Editar
                            </a>

                            <a class="btn btn-danger btn-sm"
                               href="deletar.php?id_usuario=<?= $conta['id_usuario']; ?>">
                                Deletar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>

    </body>
    </html>