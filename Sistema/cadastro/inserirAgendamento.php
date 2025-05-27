<h1>Teste</h1>
<?php
    $numTel = $_POST['num-tel']; 
    $ddd = $_POST['ddd'];
    $telCompleto = $ddd.$numTel;
    

    //pega nome do cliente
    $nome = $_POST['nome-cli'];

    //infoAgendamento
    $procedimento = $_POST['procedimento'];
    echo $procedimento;
    $data = $_POST['dataCadastro'];
    $horario = $_POST['horario'];
    $qntAgend = $_POST['qntHorario'];

    include_once '../bd.php';
 

        $stmtInsertAgnd = $bd->prepare("INSERT INTO agendamento (procedimento_id, data, horario, qnt_horario, nome_cliente, telefone) VALUES (:procedimento, :data_agend, :horario, :qnt_h, :nomeCli, :tel)");

        // Colocar o Parâmetro
        $stmtInsertAgnd->bindParam(':procedimento', $procedimento);
        $stmtInsertAgnd->bindParam(':data_agend', $data);
        $stmtInsertAgnd->bindParam(':horario', $horario);
        $stmtInsertAgnd->bindParam(':qnt_h', $qntAgend);
        $stmtInsertAgnd->bindParam(':tel', $telCompleto);
        $stmtInsertAgnd->bindParam(':nomeCli', $nome);

        $stmtInsertAgnd->execute();

        header('location: ../');

?>