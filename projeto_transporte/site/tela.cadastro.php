<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>
        Cadastro Alunos - Rota Certa
    </title>

    <link rel="stylesheet" href="mstyle.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>

<?php include 'menu.php'; ?>

<div class="conteudo">

    <h1 class="titulo">
        Cadastro de Alunos
    </h1>

    <!-- TABELA -->
    <table class="tabela-alunos" id="tabelaAlunos">

        <thead>

            <tr>

                <th>Nome</th>

                <th>Série</th>

                <th>Curso</th>

                <th>Onde mora?</th>

                <th class="coluna-acoes">
                    Ações
                </th>

            </tr>

        </thead>

        <tbody id="corpoTabela">

            <!-- LINHA MODELO -->
            <tr class="linha-modelo" style="display:none;">

                <!-- NOME -->
                <td>
                    <input type="text" name="nome[]" required>
                </td>

                <!-- SÉRIE -->
                <td>

                    <select name="serie[]">

                        <option value="1">1º</option>
                        <option value="2">2º</option>
                        <option value="3">3º</option>

                    </select>

                </td>

                <!-- CURSO -->
                <td>

                    <select name="curso[]">

                        <option value="Info">
                            Informática
                        </option>

                        <option value="DS">
                            Desenvolvimento de Sistemas
                        </option>

                    </select>

                </td>

                <!-- ENDEREÇO -->
                <td>
                    <input type="text" name="endereco[]" required>
                </td>

                <!-- AÇÕES -->
                <td class="coluna-acoes">

                    <div class="lista-acoes">

                        <!-- VISUALIZAR -->
                        <button 
                            type="button"
                            class="lista-btn-acao lista-btn-azul"
                        >

                            <span class="material-icons">
                                visibility
                            </span>

                        </button>

                        <!-- EDITAR -->
                        <button 
                            type="button"
                            class="lista-btn-acao lista-btn-amarelo"
                        >

                            <span class="material-icons">
                                edit
                            </span>

                        </button>

                        <!-- REMOVER -->
                        <button 
                            type="button"
                            class="btn-remover"
                        >

                            Remover

                        </button>

                    </div>

                </td>

            </tr>

        </tbody>

    </table>

    <!-- BOTÕES -->
    <div class="topo-acoes">

        <!-- QUANTIDADE -->
        <div class="quantidade-box">

            <label>
                Quantidade
            </label>

            <input 
                type="number"
                id="quantidadeLinhas"
                class="input-quantidade"
                min="1"
                value="1"
            >

        </div>

        <!-- ADICIONAR -->
        <button 
            type="button"
            id="btnAdd"
            class="btn-add"
        >

            + Adicionar linhas

        </button>

        <!-- SALVAR -->
        <button 
            type="submit"
            class="btn-salvar"
        >

            Salvar todos

        </button>

    </div>

</div>

<!-- JS -->
<script src="cadastro.js"></script>

</body>
</html>