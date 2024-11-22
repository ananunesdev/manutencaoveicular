<?php 
    //email, password - > formulário
    require '../includes/db.php';
    session_start();

    $error = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        //consultar banco de dados para encontrar o usuario
        $stmt = $pdo -> prepare("select * from users where email = ?;");
        $stmt -> execute([$email]);
        $user = $stmt->fetch();

        if(empty($email) || empty($password)){
            $error = "Todos os campos são obrigatórios.";
        }else{
            //verifica se o usuário existe e a senha está correta

            if($user && password_verify( $password, $user['password'])){
            //salvar o ID do usuário na sessão e redirecionar para o dashboard
            //redirecionar para o dashboard
           
                $_SESSION['user_id'] = $user['id'];

                echo $_SESSION['user_id'];
                header('refresh:5; url= dashboard.php');
                exit();
    
            }else{
                $error = "E-mail ou senha inválidos.";
             }
        }

        
    }
    include '../includes/header.php';

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Login</h2>

            <?php if(!empty($erro)):?>
                <div class="alert alert-danger"><?= $error?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Ex.: seu@email.com">
                </div>
                <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password"required>
                </div>
                <button type="submit" class="btn btn-dark w-100">Entrar</button>
            </form>
            <p class="text-center mt-3">Não tem uma conta? <a href="register.php">Registre-se</a> </p>
        </div>
    </div>

</div>
<?php include'../includes/footer.php';?>