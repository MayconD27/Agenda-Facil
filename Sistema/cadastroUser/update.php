<?php
include_once '../bd.php';
$value = $_GET['value'];
$field = $_GET['field'];
$id = $_GET['id'];
if($field =='senha'){
    $value = hash('sha256', $value); 
}
$sql = "UPDATE usuario SET $field = :valor WHERE id_user = :id";
$stmt = $bd->prepare($sql);
$stmt->bindParam(':valor', $value);
$stmt->bindParam(':id', $id);

if($stmt->execute()){
    http_response_code(200);
    echo "OK";
} else {
    http_response_code(500);
    echo "Erro ao atualizar";
}
