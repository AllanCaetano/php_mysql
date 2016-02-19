<form method="POST">
    <fieldset>
        <input type="hidden" name="id" value="<?php echo $contato['id']; ?>">
        <legend>Novo Contato</legend>
        <label>
            Nome:
            <input type="text" name="nome" value="<?php echo $contato['nome']; ?>">
            <?php if ($tem_erros && isset($erros_validacao['nome'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['nome']; ?>
                </span>
            <?php endif; ?>
        </label>
        <label>
            Telefone:
            <input type="text" id="telefone" name="telefone" value="<?php echo $contato['telefone']; ?>">
            <?php if ($tem_erros && isset($erros_validacao['telefone'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['telefone']; ?>
                </span>
            <?php endif; ?>
        </label>
        <label>
            E-mail:
            <input type="text" name="email" value="<?php echo $contato['email']; ?>">
            <?php if ($tem_erros && isset($erros_validacao['email'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['email']; ?>
                </span>
            <?php endif; ?>
        </label>
        <label>
            Data de Nascimento:
            <input type="text" id="nascimento" name="nascimento" value="<?php echo traduz_data_para_exibir($contato['nascimento']); ?>">
            <?php if ($tem_erros && isset($erros_validacao['nascimento'])): ?>
                <span class="erro">
                    <?php echo $erros_validacao['nascimento']; ?>
                </span>
            <?php endif; ?>
        </label>
        <label>
            Favorito:
            <input type="checkbox" name="favorito" value=1 <?php echo ($contato['favorito'] == 1) ? 'checked' : ''; ?>>
        </label>
        <label>
            Lembrete por e-mail:
            <input type="checkbox" name="lembrete" value=1>
        </label>
        <?php if ($contato['id'] > 0): ?>
            <div id="botoes">
                <input type="submit" id="cancelar" name="cancelar" value="Cancelar">
                <input type="submit" id="gravar" name="atualizar" value="Atualizar">
            </div>
        <?php else: ?>
            <div id="botoes">
                <input type="submit" id="gravar" name="gravar" value="Cadastrar">
            </div>
        <?php endif; ?>
    </fieldset>
</form>
<br/>

