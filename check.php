<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include_once './Sistema/bd.php';

// Pega a data via GET
$data = $_GET['data'] ?? null;

if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "Parâmetro 'data' obrigatório."
    ]);
    exit;
}

try {
    // Busca os horários já agendados para a data informada
    $sql = "SELECT horario FROM agendamento WHERE data = :data";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':data', $data);
    $stmt->execute();

    $horarios = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode([
        "status" => "success",
        "data" => $horarios
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
