<?php
include_once '../bd.php';

header('Content-Type: application/json');

$dados = json_decode(file_get_contents('php://input'), true);

$procedimento = $dados['procedimento'] ?? null;
$tempo = $dados['tempo'] ?? null;

if (!$procedimento || !is_numeric($tempo)) {
    http_response_code(400);
    echo json_encode(['message' => 'Dados inválidos']);
    exit;
}

$sql = "INSERT INTO procedimento (procedimento, hora) VALUES (:procedimento, :hora)";
$stmt = $bd->prepare($sql);
$stmt->bindParam(':procedimento', $procedimento);
$stmt->bindParam(':hora', $tempo, PDO::PARAM_INT);

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(['message' => 'Procedimento cadastrado com sucesso!']);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Erro ao cadastrar procedimento']);
}
