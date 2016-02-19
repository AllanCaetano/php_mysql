<form method="POST">
    <fieldset>
        <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
        <legend>Nova Tarefa</legend>
        <label>
            Tarefa:
            <input type="text" name="nome" value="<?php echo $tarefa['nome']; ?>">
            <?php if ($tem_erros && isset($erros_validacao['nome'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['nome']; ?>
                </span>
            <?php endif; ?>
        </label>
        <label>
            Descrição (Opcional):
            <textarea name="descricao"><?php echo $tarefa['descricao']; ?></textarea>
        </label>
        <label>
            Prazo (Opcional):
            <input type="text" id="prazo" name="prazo" value="<?php echo traduz_data_para_exibir($tarefa['prazo']); ?>">
            <?php if ($tem_erros && isset($erros_validacao['prazo'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['prazo']; ?>
                </span>
            <?php endif; ?>
        </label><br/>
        <fieldset id="prioridade">
            <legend>Prioridade</legend>
            <label>
                <input type="radio" name="prioridade" value=1 <?php echo ($tarefa['prioridade'] == 1) ? 'checked' : ''; ?>>
                Baixa

                <input type="radio" name="prioridade" value=2 <?php echo ($tarefa['prioridade'] == 2) ? 'checked' : ''; ?>>
                Média

                <input type="radio" name="prioridade" value=3 <?php echo ($tarefa['prioridade'] == 3) ? 'checked' : ''; ?>>
                Alta
            </label>
        </fieldset>
        <label>
            Tarefa concluída:
            <input type="checkbox" name="concluida" value=1 <?php echo ($tarefa['concluida'] == 1) ? 'checked' : ''; ?>>
        </label>
        <label>
            Lembrete por e-mail:
            <input type="checkbox" name="lembrete" value=1>
        </label>
        <?php if ($tarefa['id'] > 0): ?>
            <div id="botoes">
                <input type="submit" name="cancelar" id="cancelar" value="Cancelar">
                <input type="submit" name="atualizar" id="gravar" value="Atualizar">
            </div>
        <?php else: ?>
            <div id="botoes">
                <input type="submit" name="cadastrar" id="gravar" value="Cadastrar">
            </div>
        <?php endif; ?>
    </fieldset>
</form>
<br/>