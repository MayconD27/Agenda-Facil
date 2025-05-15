<?php
include_once '../bd.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    http_response_code(400);
    echo "ID inválido";
    exit;
}

$sql = "DELETE FROM procedimento WHERE id = :id";
$stmt = $bd->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    http_response_code(200);
    echo "Deletado com sucesso";
} else {
    http_response_code(500);
    echo "Erro ao deletar";
}
