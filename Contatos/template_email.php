<h1>Contato: <?php echo $contato['nome']; ?></h1>

<p>
    <strong>Telefone: </strong>
    <?php echo $contato['telefone']; ?>
</p>

<p>
    <strong>E-mail: </strong>
    <?php echo $contato['email']; ?>
</p>

<p>
    <strong>Data de nascimento: </strong>
    <?php echo traduz_data_para_exibir($contato['nascimento']); ?>
</p>

<p>
    <strong>Favorito: </strong>
    <?php echo traduz_favorito($contato['favorito']); ?>
</p>

<?php if (count($anexos) > 0): ?>
    <p>
        <strong>Atenção!</strong>
        Este contato contém anexos!
    </p>
<?php endif; ?>
