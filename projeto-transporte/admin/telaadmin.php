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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
        <!--Inicio da barra nav pq sinceramente n sei organizar-->
        <nav class="navbar navbar-expand-lg bg-body-tertiary bg-site" data-bs-theme="dark">
        <div class="container-fluid">    

            <ul class="nav justify-content-center">
            
            <li class="nav-item">
                <a class="navbar-brand btn btn-primary btn-sm" href="../index.php">Voltar</a>
            </li>

            <li class="nav-item">
                <a class="navbar-brand btn btn-danger btn-sm" href="cadastro.php">Cadastrar nova conta</a>
            </li>
            
            </ul>
            <!--Fim da barra de nav -->
        
        </div>
        </nav>
    
     <div class="container mt-4">

        <h2 class="mt-4">Contas Cadastradas:</h2>
        <h5 class="mt-4">(A senha é alterada pelo usuário)</h5>

        <!-- TABELA -->
         <div class="container">
            <div class="card">

                <div class="table-responsive mt-3">
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <!--listador o que vai preencher a tela basicamente, a lista né no caso -->
                            <?php foreach ($lista_contas as $conta): ?>
                                <tr>
                                    <td><?= $conta['login']; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                        href="editar.php?id_usuario=<?= $conta['id_usuario']; ?>">
                                        Editar Email
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

            </div>
            
        </div>
        
    </body>
    </html>