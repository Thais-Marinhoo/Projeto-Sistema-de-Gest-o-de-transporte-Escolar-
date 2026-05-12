<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Rota Certa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body>
    
    
    <div class="container-login">
        <div class="card-login">
            
                <!-- ALERTA DE SUCESSO E ERRO -->
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
                    
                    <img class="logo" src="logo.png" alt="Logo Rota Certa">
                    
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
                    
                    
                    <!-- Modal de redefinição com fluxo em 3 etapas -->
                    <div id="modalReset" class="modal-fake">
                        <div class="card-login" id="step-email">
                            <a href="#" class="btn-fechar">&times;</a>
                            <h5 class="fw-bold text-center">Redefinir Senha</h5>
                            <hr>
                            <label>Confirme seu e-mail</label>
                            <input type="email" id="reset-email" required>
                            <button class="btn-login" id="btn-request">Enviar código</button>
                            <a href="#" class="btn btn-sm btn-link d-block text-center mt-3 text-muted">Cancelar</a>
                        </div>

                        <div class="card-login" id="step-code" style="display:none;">
                            <a href="#" class="btn-fechar">&times;</a>
                            <h5 class="fw-bold text-center">Informe o código</h5>
                            <hr>
                            <label>Código recebido por e-mail</label>
                            <input type="text" id="reset-code" required>
                            <button class="btn-login" id="btn-verify">Verificar código</button>
                            <a href="#" class="btn btn-sm btn-link d-block text-center mt-3 text-muted" id="btn-back-to-email">Voltar</a>
                        </div>

                        <div class="card-login" id="step-newpass" style="display:none;">
                            <a href="#" class="btn-fechar">&times;</a>
                            <h5 class="fw-bold text-center">Nova senha</h5>
                            <hr>
                            <label>Nova senha</label>
                            <input type="password" id="reset-newpass" required>
                            <label>Confirme a nova senha</label>
                            <input type="password" id="reset-newpass-confirm" required>
                            <button class="btn-login" id="btn-reset">Salvar nova senha</button>
                            <a href="#" class="btn btn-sm btn-link d-block text-center mt-3 text-muted">Cancelar</a>
                        </div>
                    </div>

                    <script>
                        // Funções utilitárias
                        function showStep(id){
                            document.getElementById('step-email').style.display = 'none';
                            document.getElementById('step-code').style.display = 'none';
                            document.getElementById('step-newpass').style.display = 'none';
                            document.getElementById(id).style.display = 'block';
                        }

                        document.getElementById('btn-request').addEventListener('click', function(e){
                            e.preventDefault();
                            const email = document.getElementById('reset-email').value.trim();
                            if(!email) return alert('Informe o e-mail');

                            fetch('alterar.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                body: 'action=request&email=' + encodeURIComponent(email)
                            }).then(r=>r.json()).then(res=>{
                                alert(res.message);
                                showStep('step-code');
                            }).catch(err=>{alert('Erro ao enviar pedido');console.error(err)});
                        });

                        document.getElementById('btn-verify').addEventListener('click', function(e){
                            e.preventDefault();
                            const email = document.getElementById('reset-email').value.trim();
                            const code = document.getElementById('reset-code').value.trim();
                            if(!code) return alert('Informe o código');

                            fetch('alterar.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                body: 'action=verify&email=' + encodeURIComponent(email) + '&code=' + encodeURIComponent(code)
                            }).then(r=>r.json()).then(res=>{
                                if(res.success){
                                    showStep('step-newpass');
                                } else {
                                    alert(res.message);
                                }
                            }).catch(err=>{alert('Erro ao verificar código');console.error(err)});
                        });

                        document.getElementById('btn-reset').addEventListener('click', function(e){
                            e.preventDefault();
                            const email = document.getElementById('reset-email').value.trim();
                            const p1 = document.getElementById('reset-newpass').value;
                            const p2 = document.getElementById('reset-newpass-confirm').value;
                            if(!p1 || p1 !== p2) return alert('Senhas não correspondem');

                            fetch('alterar.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                body: 'action=reset&email=' + encodeURIComponent(email) + '&newpass=' + encodeURIComponent(p1)
                            }).then(r=>r.json()).then(res=>{
                                alert(res.message);
                                if(res.success) window.location.href = 'index.php?status=sucesso';
                            }).catch(err=>{alert('Erro ao resetar senha');console.error(err)});
                        });

                        document.getElementById('btn-back-to-email').addEventListener('click', function(e){
                            e.preventDefault(); showStep('step-email');
                        });
                    </script>

    </div>
</div>

</body>
</html>