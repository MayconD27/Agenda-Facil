<?php

$ocupados = ['09:00:00', '10:00:00', '11:00:00'];
$selecionado = '08:00:00';
$quantidade = 0;

$todosHorarios = array_map(fn($i) => sprintf('%02d:00:00', $i), range(7, 19));

foreach ($todosHorarios as $horario) {
    if (in_array($horario, $ocupados)) {
        echo "O horário $horario está ocupado.\n";
    } else {
        echo "O horário $horario está disponível.\n";
    }

    if (strtotime($horario) >= strtotime($selecionado) && !in_array($horario, $ocupados)) {
        $quantidade++;
    }

    if (strtotime($horario) >= strtotime($selecionado) && in_array($horario, $ocupados)) {
        break;
    }
}

echo "Quantidade de horários disponíveis a partir de $selecionado: " . $quantidade;
?>
