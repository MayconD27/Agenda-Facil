<?php
include 'bd.php';

header('Content-Type: application/json');

$data = $_GET['data'] ?? '';
$horario = $_GET['horario'] ?? '';
$response = ['success' => false];

if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $data) && preg_match('/^\d{2}:\d{2}:\d{2}$/', $horario)) {
    
    $stmt = $bd->prepare("SELECT horario FROM agendamento WHERE data = :data");
    $stmt->execute([':data' => $data]);
    $ocupados = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $todosHorarios = array_map(fn($i) => sprintf('%02d:00:00', $i), range(7, 19));
    
    $quantidade = 0;

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
