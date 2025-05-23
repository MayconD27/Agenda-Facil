<h1>Dados do cliente <i class="bi bi-person"></i> </h1>
<input type="text" id="nome" name="nome-cli" placeholder="Nome do cliente">

<div class="tel">
    <input type="text" placeholder="DDD" class="ddd" name="ddd" maxlength=2 required id="ddd"> 
    <input type="text" placeholder="Telefone (Apenas números)" name="num-tel" id="num" onchange="ModoNum()" class="num-tel" maxlength=9 required>
</div>
<?php
// Consulta os procedimentos do banco
$sql = "SELECT id, procedimento FROM procedimento ORDER BY procedimento ASC";
$resultado = $bd->prepare($sql);
$resultado->execute();
?>

<select name="procedimento" id="proc" required>
    <option value="" disabled selected>Selecione um procedimento</option>
    <?php
    foreach ($resultado as $r) {
        $id = $r['id'];
        $nomeProc = htmlspecialchars($r['procedimento']);
        echo "<option value=\"$id\">$nomeProc</option>";
    }
    ?>
</select>

<p id="process">**Por favor, descreva o procedimento a ser realizado, como por exemplo escova progressiva, corte, coloração, etc.</p>