<h1>Teste</h1>
<?php
    $numTel = $_POST['telefone'];     
    //pega nome do cliente
    $nome = $_POST['nome'];
    //infoAgendamento
    $procedimento = $_POST['procedimento'];
    $data = $_POST['data_agnd'];
    $horario = $_POST['horas'];
    $qntAgend = 1;

    print_r($_POST);
    include_once './Sistema/bd.php';

        
        $stmtInsertAgnd = $bd->prepare("INSERT INTO agendamento (procedimento_id, data, horario, qnt_horario, nome_cliente, telefone) VALUES (:procedimento, :data_agend, :horario, :qnt_h, :nomeCli, :tel)");

        // Colocar o Parâmetro
        $stmtInsertAgnd->bindParam(':procedimento', $procedimento);
        $stmtInsertAgnd->bindParam(':data_agend', $data);
        $stmtInsertAgnd->bindParam(':horario', $horario);
        $stmtInsertAgnd->bindParam(':qnt_h', $qntAgend);
        $stmtInsertAgnd->bindParam(':tel', $numTel);
        $stmtInsertAgnd->bindParam(':nomeCli', $nome);

        $stmtInsertAgnd->execute();

        header('location: ./');


?>