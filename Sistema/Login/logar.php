<?php
    session_start();
    include_once "../bd.php";

    $email = ($_POST['email']) ?  $_POST['email'] : '';
    $senha = ($_POST['senha']) ?  $_POST['senha'] : '';

    $hash = "";
    if(!empty($senha)){
        $hash = hash('sha256', $senha);
    }

    // SQL com prepared statement
    $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";

    // Prepara a consulta
    $resultado = $bd->prepare($sql);

    // Faz o bind dos parâmetros
    $resultado->bindParam(':email', $email);
    $resultado->bindParam(':senha', $hash);

    // Executa a consulta
    $resultado->execute();
    
    // Recupera os registros
    $registros = $resultado->fetchAll();

    if ($registros) {
        echo $registros[0]['nome']; // Corrigido a linha de echo
        $_SESSION['logado'] = true;
        $_SESSION['nome'] = $registros[0]['nome'];
        $_SESSION['id'] = $registros[0]['id_user'];
        $_SESSION['adm'] = $registros[0]['adm'];
        


        // Redireciona para a página inicial
        header('location: ../');
        exit;
    } else {
        // Caso não encontre o usuário
        header('location: mensagem_erro.php');
        exit;
    }
?>
