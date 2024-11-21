<?php 
    //email, password - > formulário
    require '../includes/db.php';
    session_start();

    $error = '';

    //verificar se formulário foi enviado

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = trim($_POST['$email']);
        $password = trim($_POST['$password']);

        
    }

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