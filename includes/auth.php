<?php 
//validação do meu usuário

    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: ../pages/login.php");
        exit();

    }

?>


