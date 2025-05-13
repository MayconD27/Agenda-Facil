<?php
    include_once '../bd.php';
    session_start();
    $usuarioLogado = isset($_SESSION['logado']) ?  $_SESSION['logado'] : false;

    if($usuarioLogado== false){
        header('location: ../Login');
        exit;
    }
    $nome_user = isset($_POST['nome']) ? $_POST['nome'] : "";
    $email_user = isset($_POST['email']) ? $_POST['email'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
    $tipo = intval(isset($_POST['tipo']) ? $_POST['tipo'] : 0);
    echo "Nome do usuário: $nome_user";
    echo $senha;
    $hash = "";
    if(!empty($senha)){
        $hash = hash('sha256', $senha);
    }

            
    $stmtInsertAgnd = $bd->prepare("INSERT INTO usuario (nome, email, senha,adm,ativo) VALUES (:nome, :email, :senha, :adm, 1)");

    // Colocar o Parâmetro
    $stmtInsertAgnd->bindParam(':nome', $nome_user);
    $stmtInsertAgnd->bindParam(':email', $email_user);
    $stmtInsertAgnd->bindParam(':senha', $hash);
    $stmtInsertAgnd->bindParam(':adm', $tipo);


    $stmtInsertAgnd->execute();

    
?>


