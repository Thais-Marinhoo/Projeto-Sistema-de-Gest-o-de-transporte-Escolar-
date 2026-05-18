<?php

include '../conexao.php';

$nomes = $_POST['nome'];
$series = $_POST['serie'];
$cursos = $_POST['curso'];
$enderecos = $_POST['endereco'];

for($i = 0; $i < count($nomes); $i++){

    $nome = trim($nomes[$i]);
    $serie = trim($series[$i]);
    $curso = trim($cursos[$i]);
    $endereco = trim($enderecos[$i]);

    // NÃO CADASTRA VAZIO
    if(
        empty($nome) ||
        empty($serie) ||
        empty($curso) ||
        empty($endereco)
    ){
        continue;
    }

    // VERIFICA NOME REPETIDO
    $sqlVerifica = "
        SELECT *
        FROM aluno
        WHERE nome = '$nome'
    ";

    $resultado = mysqli_query($conexao, $sqlVerifica);

    if(mysqli_num_rows($resultado) > 0){

        echo "
        <script>
            alert('Aluno já cadastrado!');
            window.location='cadastro.php';
        </script>
        ";

        exit();

    }

    // INSERE
    $sql = "
        INSERT INTO aluno
        (
            nome,
            endereco,
            serie,
            curso
        )
        VALUES
        (
            '$nome',
            '$endereco',
            '$serie',
            '$curso'
        )
    ";

    mysqli_query($conexao, $sql);

}

echo "
<script>
    alert('Alunos cadastrados com sucesso!');
    window.location='lista_alunos.php';
</script>
";
?>