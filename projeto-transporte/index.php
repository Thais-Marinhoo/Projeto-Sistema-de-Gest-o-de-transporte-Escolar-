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
    
    
    <div class="container-login">
        <div class="card-login">
            
                <!-- ALERTA DE SUCESSO -->
                <?php if(isset($_GET['status']) && $_GET['status'] == 'sucesso'): ?>
                    <div class="alert alert-success text-center py-2" style="font-size: 14px;">
                        Senha atualizada com sucesso!
                    </div>
                <?php endif; ?>
                
                    <?php if(isset($_GET['status']) && $_GET['status'] == 'mistake'): ?>
                        <div class="alert alert-danger text-center py-2" style="font-size: 14px;">
                            Senha ou Email inválidos!
                        </div>
                    <?php endif; ?>
                    
                    <img class="logo" src="logo.jpeg" alt="Logo Rota Certa">
                    
                    <form action="login.php" method="POST">
                        <label>E-mail</label>
                        <input type="email" name="email" required>
                        
                        <label>Senha</label>
                        <input type="password" name="senha" required>
                        
                        <!-- Link que antes era index.php?show_reset=true agora aponta para o ID -->
                        <div class="esqueceu">
                            Esqueceu sua senha? <a href="#modalReset">Clique aqui</a>
                        </div>

                        <button class="btn-login">Login</button>
                    </form>
                    
                    
                    <!-- ESTRUTURA DO MODAL SEM JS -->
                    <div id="modalReset" class="modal-fake">
                        <div class="card-login">
                            <a href="#" class="btn-fechar">&times;</a>
                            <h5 class="fw-bold text-center">Alterar Senha</h5>
                            <hr>
                            
                            <form action="alterar.php" method="POST">
                                <label>Confirme seu e-mail</label>
                                <input type="email" name="email_reset" required>
                                
                                <label>Nova senha</label>
                                <input type="password" name="nova_senha" required>
                                
                                <button class="btn-login">Salvar Nova Senha</button>
                    <a href="#" class="btn btn-sm btn-link d-block text-center mt-3 text-muted">Cancelar</a>
                </form>
            </div>
        </div>

    </div>
</div>

</body>
</html>