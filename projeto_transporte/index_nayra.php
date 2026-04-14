<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#0b2a4a;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.container{
    background:#102f52;
    padding:50px;
    border-radius:10px;
    width:350px;
    text-align:center;
}

.logo{
    width:200px;
    margin-bottom:15px;
}

label{
    display:block;
    text-align:left;
    color:#fff;
    margin-top:10px;
}

input{
    width:100%;
    padding:8px;
    border-radius:6px;
    border:none;
    margin-top:5px;
}

.btn-login{
    width:100%;
    padding:10px;
    margin-top:15px;
    background:#f4c430;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
    font-size:15px;
}

.links{
    margin-top:10px;
    font-size:20px;
    color:#fff;
}

.links a{
    color:#f4c430;
    text-decoration:none;
    font-weight:bold;
    cursor:pointer;
}

.popup{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.6);
    justify-content:center;
    align-items:center;
}

.popup-content{
    background:#fff;
    padding:20px;
    border-radius:10px;
    text-align:center;
    width:250px;
}

.popup-content input{
    width:100%;
    margin-top:10px;
}

.close{
    margin-top:10px;
    padding:8px;
    background:#0b2a4a;
    color:#fff;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
</style>
</head>

<body>

<div class="container">
    <img class="logo" src="logo.png" alt="Logo Rota Certa">

    <form action="login.php" method="POST">
        <label>E-mail</label>
        <input type="email" name="email" required>

        <label>Senha</label>
        <input type="password" name="senha" required>

        <div class="links">
            Esqueceu sua senha?
            <a href="#" onclick="abrirPopup(); return false;">Clique aqui</a>
        </div>

        <button class="btn-login">Login</button>
    </form>
</div>

<div class="popup" id="popup">
    <div class="popup-content">
        <h3>Recuperar senha</h3>
        <input type="email" placeholder="Digite seu e-mail">
        <button class="close" onclick="fecharPopup()">Enviar</button>
    </div>
</div>

<script>
function abrirPopup(){
    document.getElementById("popup").style.display = "flex";
}

function fecharPopup(){
    document.getElementById("popup").style.display = "none";
}
</script>

</body>
</html>