<?php
include 'bd.php'; // Inclui a conexão

header('Content-Type: application/json');

$data = $_GET['data'] ?? '';
$response = ['success' => false];

if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $data)) {
    $horarios = array_map(fn($i) => sprintf('%02d:00:00', $i), range(7, 19));
    
    // Busca os horários ocupados e suas quantidades
    $stmt = $bd->prepare("SELECT horario, qnt_horario FROM agendamento WHERE data = :data");
    $stmt->execute([':data' => $data]);
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Armazenar horários ocupados
    $ocupados = [];
    foreach ($agendamentos as $agendamento) {
        $horario = $agendamento['horario'];
        $quantidade = $agendamento['qnt_horario'];
        
        // Adiciona o horário ocupado e os próximos horários com base na quantidade
        for ($i = 0; $i < $quantidade; $i++) {
            $proximoHorario = date('H:i:s', strtotime($horario) + ($i * 3600)); // Aumenta em 1 hora
            $ocupados[] = $proximoHorario; // Armazena o horário ocupado
        }
    }

    // Calcula os horários disponíveis
    $disponiveis = array_values(array_diff($horarios, $ocupados));
    $response = ['success' => true, 'data' => $disponiveis];
} else {
    $response['error'] = 'Data inválida. O formato deve ser YYYY-MM-DD.';
}

echo json_encode($response);
?>
