<form method="POST">
    <fieldset>
        <legend>Novo Veículo</legend>
        <input type="hidden" name="id" value="<?php echo $veiculo['id']; ?>"> 
        <label>
            Placa:
            <input type="text" id="placa" name="placa" value="<?php echo $veiculo['placa']; ?>">
            <?php if ($tem_erros && isset($erros_validacao['placa'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['placa'] ?>
                </span>
            <?php endif; ?>
        </label>
        <label>
            Marca:
            <input type="text" id="marca" name="marca" value="<?php echo $veiculo['marca']; ?>">
            <?php if ($tem_erros && isset($erros_validacao['marca'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['marca'] ?>
                </span>
            <?php endif; ?>
        </label>
        <label>
            Modelo:
            <input type="text" id="modelo" name="modelo" value="<?php echo $veiculo['modelo']; ?>">
            <?php if ($tem_erros && isset($erros_validacao['modelo'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['modelo'] ?>
                </span>
            <?php endif; ?>
        </label>
        <label>
            Hora entrada:
            <input type="text" id="hora_entrada" name="hora_entrada" value="<?php echo $veiculo['hora_entrada']; ?>">
            <?php if ($tem_erros && isset($erros_validacao['hora_entrada'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['hora_entrada'] ?>
                </span>
            <?php endif; ?>
        </label>
        <label>
            Hora saída:
            <input type="text" id="hora_saida" name="hora_saida" value="<?php echo $veiculo['hora_saida']; ?>">
            <?php if ($tem_erros && isset($erros_validacao['hora_saida'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['hora_saida'] ?>
                </span>
            <?php endif; ?>
        </label>
        <label>
            Lembrete por e-mail:
            <input  type="checkbox" name="lembrete" value=1>
        </label>
        
        <?php if ($veiculo['id'] > 0): ?>
            <div id="botoes">
                <input type="submit" id="cancelar" name="cancelar" value="Cancelar">
                <input type="submit" id="gravar" name="atualizar" value="Atualizar">
            </div>
        <?php else: ?>
            <div id="botoes">
                <input type="submit" id="gravar" name="cadastrar" value="Cadastrar">
            </div>
        <?php endif; ?>
    </fieldset>
</form>
<br/>

