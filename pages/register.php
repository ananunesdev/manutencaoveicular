<?php 
    require '../config/db.php'; //gerar conexão com o banco de dados
    session_start(); 
    
    $error = '';
    $sucess = '';

    //verificar se o formulário foi enviado

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password_confirm = trim($_POST['password_confirm']);

        //validações básicas

        if(empty($username) || empty($email) || empty($password) || empty($password_confirm)){
            $error = "Todos os campos são obrigatórios";
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email = "E-mail inválido.";
        }else if($password !== $password_confirm){
            $error = "As senhas não coincidem";
        }else{
            //verificar se o email já está cadastrado
            $stmt = $pdo -> prepare("select * from users where email = ?");
            $stmt -> execute(['$email']);
            if($stmt -> rowCount()>0){
                $error = "Este e-mail já está cadastrado.";
            }else{
                //criptografa a senha e salvar no banco de dados
                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo -> prepare("insert into users (username, email, password) values (?,?,?);" );
                $stmt -> execute([$username, $email, $hashed_password]);
                $sucess = "Registro realizado com sucesso! Faça login para continuar.";
            }
        }
    }
    
    include '../includes/header.php';

?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center">Registrar-se</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error; ?> </div>
        <?php elseif (!empty($sucess)): ?>
            <div class="alert alert-sucess"><?= $sucess; ?> </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">
                 Nome de usuário
                </label>
                <input type="text" class="form-control" id="username" name="username" required placeholder="Ex.: José Maria da Silva">
            </div>
            <div class = "mb-3">
                <label for="email" class="form-label">
                    E-mail
                </label>
                <input type="email" class="form-control" id="email" name="email"required placeholder="Ex.: meu@email.com">
            </div>
            <div class = "mb-3">
                <label for="password" class="form-label">
                    Senha
                </label>
                <input type="password" class="form-control" id="password" name="password"required>
            </div>
            <div class = "mb-3">
                <label for="password_confirm" class="form-label">
                    Confirmar senha
                </label>
                <input type="password_confirm" class="form-control" id="password_confirm" name="password_confirm"required>
            </div>
          utton type="submit" class="btn btn-primary w-100">
                Registrar-se
            </button>
        </form>
        <p class="text-center mt-3">
            Já possui uma conta! <a href="login.php">Faça login</a>
        </p>
    </div>
</div>