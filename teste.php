<?php
include 'bd.php'; // Inclua sua conexão com o banco de dados aqui

// Defina a data de teste
$data = '2024-10-20'; // Exemplo de data

// Busca agendamentos na data especificada
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

// Todos os horários disponíveis
$todosHorarios = array_map(fn($i) => sprintf('%02d:00:00', $i), range(7, 19));

// Preparar horários disponíveis
$horariosDisponiveis = [];
foreach ($todosHorarios as $h) {
    if (!in_array($h, $ocupados)) {
        $horariosDisponiveis[] = $h; // Adiciona horários que não estão ocupados
    }
}

// Você pode usar as variáveis $ocupados e $horariosDisponiveis conforme necessário
?>
