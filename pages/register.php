<?php
    include '../includes/header.php';
    require '../includes/db.php'; //GERAR CONEXÃO COM O BANCO DE DADOS
    session_start(); //INCLUIR O CÓDIGO PARA CRIAR O USUÁRIO!!!
   
    $erro='';
    $sucess='';
    //VERIFICAR SE O FORMULÁRIO FOI ENVIADO
 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //IGUALDADE ABSOLUTA = 100% IGUAL (A condição 100% igual aos valores verificados)
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password_confirm = trim($_POST['password_confirm']);
 
        if(empty($username) || empty($email) || empty($password) ||empty($password_confirm) ){
            $erro="Todos os campos são obrigatórios";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //DIFERENTE É EXCLAMAÇÃO !
            $erro = "E-mail inválido";
        }elseif($password !== $password_confirm){ //!== 100% DIFERENTE ABSOLUTO (Sim e Sim) != 50% DIFERENTE (Sim e SIM)
            $erro="As senhas não coincidem.";
        }else{
            //VERIFICA SE O EMAIL JÁ ESTÁ CADASTRADO
            $stmt = $pdo->prepare("select * from users where email = ?;"); //INTERRROGAÇÃO OU VARIAVEL
            $stmt->execute(['$email']);
            //VERIFICA SE HÁ O E-MAIL JÁ CADASTRADO OU NÃO
            if($stmt->rowCount()>0){ //VERIFICA A QUANTIDADE DE LINHAS NA TABELA DO BANCO DE DADOS
                $error = "Este E-mail já está cadastrado.";
            }else{
                //CRIPITOGRAFAR A SENHA E SALVAR NO BANCO DE DADOS
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); //CRIPITOGRAFA A SENHA (DO PRÓPRIO PHP?)
                $stmt= $pdo->prepare("insert into users(username, email, password)value(?,?,?);");
                $stmt->execute([$username, $email, $hashed_password]);
                $sucess = "Registro realizado com sucesso! Faça login para continuar.";
            }
        }
 
    }
 
 
?>
 
 
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center">Registrar-se</h2>
 
        <!--MESCLANDO O PHP-->
        <?php if(!empty($erro)):?>
            <div class="alert alert-danger"><?= $error?></div>
        <?php elseif(!empty($sucess)):?>
            <div class="alert alert-success"><?=$sucess?></div>
        <?php endif; ?>    
 
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">
                    Nome de usuário
                </label>
                <input type="text" class="form-control" id="username" name="username" required placeholder="Ex.: José Alcantra Teixeira">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">
                    E-mail
                </label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Ex.: meu@email.com">
            </div>
            <div class="mb-3">
            <label for="senha" class="form-label">
                    Senha
                </label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="">
            </div>
            <div class="mb-3">
            <label for="senha" class="form-label">
                   Confirme sua senha
                </label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required placeholder="">
            </div>
            <button type="submit" class="btn btn-dark w-100">Registrar</button>
            <!-- <button type="submit" class="btn btn-primary w-100">Registrar</button> -->
        </form>
        <p class="text-center mt-3">Já possui uma conta? <a href="login.php">Faça Login</a></p>
    </div>
</div>
 
 
<?php
    include '../includes/footer.php';
//MUITAS COISAS SÃO DO APACHE
?>