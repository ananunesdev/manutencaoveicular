<?php 
    //ver se está logado
    require '../includes/auth.php';
    require '../includes/header.php';


?>
<div class="container text-center">
    <h1 >Bem-vindo(a) ao Sistema de Manutenção</h1>
    <p>Escolha uma das opções abaixo:</p>
    <div class="list-group">
        <a href="view-vehicles.php" class="list-group-item list-group-item-action">Visualizar Veículos</a>
        <a href="add-vehicles.php" class="list-group-item list-group-item-action">Adicionar Veículos</a>
        <a href="add-maintenance.php" class="list-group-item list-group-item-action">Adicionar Manutenção</a>
        <a href="maintenance-types.php" class="list-group-item list-group-item-action">Gerenciar Tipos de Manutenção</a>
        <a href="vehicles-report.php" class="list-group-item list-group-item-action">Relatório de Veículos</a>
    </div>
</div>

