<?php
include 'bd.php'; // Inclui a conexão

header('Content-Type: application/json');

$data = $_GET['data'] ?? '';
$response = ['success' => false];

if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $data)) {
    $horarios = array_map(fn($i) => sprintf('%02d:00:00', $i), range(7, 19));
    $stmt = $bd->prepare("SELECT horario FROM agendamento WHERE data = :data");
    $stmt->execute([':data' => $data]);
    $ocupados = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $response = ['success' => true, 'data' => array_values(array_diff($horarios, $ocupados))];
} else {
    $response['error'] = 'Data inválida. O formato deve ser YYYY-MM-DD.';
}

echo json_encode($response);
?>
