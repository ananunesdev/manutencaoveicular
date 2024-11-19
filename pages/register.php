<?php 
    require '../config/db.php'; //gerar conexão com o banco de dados
    session_start(); 
    
    
    include '../includes/header.php';

?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center">Registrar-se</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">
                    Nome de usuário
                </label>
                <input type="text" class="form-control" id="username" name="username" required placeholder="Ex.: José Maria da Silva">
            </div>
        </form>
    </div>
</div>