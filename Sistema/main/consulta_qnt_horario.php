<?php
include '../bd.php';

header('Content-Type: application/json');

$data = $_GET['data'] ?? '';
$horario = $_GET['horario'] ?? '';
$response = ['success' => false];

if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $data) && preg_match('/^\d{2}:\d{2}:\d{2}$/', $horario)) {
    
    // Busca os agendamentos na data especificada
    $stmt = $bd->prepare("SELECT horario, qnt_horario FROM agendamento WHERE data = :data");
    $stmt->execute([':data' => $data]);
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Armazenar horários ocupados e suas quantidades
    $ocupados = [];
    foreach ($agendamentos as $agendamento) {
        $horarioOcupado = $agendamento['horario'];
        $quantidade = $agendamento['qnt_horario'];
        
        // Adiciona o horário ocupado e os próximos horários com base na quantidade
        for ($i = 0; $i < $quantidade; $i++) {
            $proximoHorario = date('H:i:s', strtotime($horarioOcupado) + ($i * 3600)); // Aumenta em 1 hora
            $ocupados[] = $proximoHorario; // Armazena o horário ocupado
        }
    }

    // Todos os horários disponíveis
    $todosHorarios = array_map(fn($i) => sprintf('%02d:00:00', $i), range(7, 19));
    
    $quantidade = 0;

    // Contar horários disponíveis a partir do horário selecionado
    foreach ($todosHorarios as $h) {
        if (strtotime($h) >= strtotime($horario)) {
            if (in_array($h, $ocupados)) {
                break; // Para de contar ao encontrar um horário ocupado
            }
            $quantidade++; // Incrementa a contagem
        }
    }

    $response = ['success' => true, 'quantidade' => $quantidade];
} else {
    $response['error'] = 'Data ou horário inválidos.';
}

echo json_encode($response);
?>
