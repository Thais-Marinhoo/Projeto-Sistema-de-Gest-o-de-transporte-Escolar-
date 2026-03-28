<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Rota Certa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

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

.topo{
    padding:18px 30px;
    font-weight:600;
    font-size:20px;
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

<div class="topo">
    Sistema de Transporte Escolar
</div>

<div class="container-login">
    <div class="card-login">

       
        <img class="logo" src="img/logo.png" alt="Logo Rota Certa">

        <form action="login.php" method="POST">
            <label>E-mail</label>
            <input type="email" name="email" required>

            <label>Senha</label>
            <input type="password" name="senha" required>

            <button class="btn-login">Login</button>
        </form>

        <div class="esqueceu">
            /* esqueceu sua senha*/
            Esqueceu sua senha? <a href="pensardps.php">Clique aqui</a>
        </div>

    </div>
</div>

</body>
</html>
