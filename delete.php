<?php
    include_once 'bd.php';
    // Obtém o ID diretamente da URL
    $idAgend = $_GET['id'];

    // Preparar a consulta DELETE
    $stmtInsert = $bd->prepare("DELETE FROM agendamento WHERE id_agenda = :idAg");

    // Associar o parâmetro :idAg com o valor de $idAgend
    $stmtInsert->bindParam(':idAg', $idAgend, PDO::PARAM_INT);

    // Executar a consulta
    $stmtInsert->execute();

    // Redirecionar após o DELETE
    header('Location: ./');
    exit();  // Garante que o redirecionamento seja feito imediatamente
?>
