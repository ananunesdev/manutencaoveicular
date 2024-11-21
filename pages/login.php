<?php 
    //email, password - > formulário
    require '../includes/db.php';
    session_start();

    $error = '';

    //consultar banco de dados para encontrar o usuario

    $stmt = $pdo -> prepare("select * from users where email = ?;");
    $stmt -> execute([$email]);
    $user = $stmt->fetch();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = trim($_POST['$email']);
        $password = trim($_POST['$password']);

        if(empty($email) || empty($password)){
            $error = "Todos os campos são obrigatórios.";
        }else{
            //verifica se o usuário existe e a senha está correta

            if($user && password_verify($password, $user['password'])){
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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
</body>
</html>