<h1>Dados do cliente <i class="bi bi-person"></i> </h1>
<input type="text" id="nome" name="nome-cli" placeholder="Nome do cliente">

<div class="tel">
    <input type="text" placeholder="DDD" class="ddd" name="ddd" maxlength=2 required> 
    <input type="text" placeholder="Telefone (Apenas números)" name="num-tel" id="num-tel" onchange="ModoNum()" class="num-tel" maxlength=9 required>
</div>
<input type="text" placeholder="procedimento" name="procedimento" required>

<p id="process">**Por favor, descreva o procedimento a ser realizado, como por exemplo escova progressiva, corte, coloração, etc.</p>