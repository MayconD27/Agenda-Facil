<?php
// Configuração do cabeçalho para permitir requisições de outras origens e retornar JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Inclui a conexão com o banco de dados
include_once './Sistema/bd.php';

try {
    // Query para buscar os procedimentos
    $sql = "SELECT id, procedimento, hora FROM procedimento";
    $stmt = $bd->prepare($sql);
    $stmt->execute();

    // Busca todos os resultados como array associativo
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retorna os dados em formato JSON
    echo json_encode([
        "status" => "success",
        "data" => $dados
    ]);
} catch (PDOException $e) {
    // Retorna erro em caso de falha
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>
