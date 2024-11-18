<?php 
    //iniciar a sessão
    session_start();

    //verificar se o usuário está logado
    if(isset($_SESSION['user_id'])){
        //redirecionar para a dashboard se o usuário estiver logado
        header("Location: pages/dashboard.php");
        exit();
    }else{
        //redirecionar para o login se o usuário não estiver logado
        header("Location: pages/login.php");
        exit();
    }

?>