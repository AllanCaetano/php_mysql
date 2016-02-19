<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Contatos</title>
    <link rel="stylesheet" href="../assets/css/estilo.css" type="text/css">
</head>
<body>
    <div id="centro">
        <h1>Nome: <?php echo $contato['nome']; ?></h1>
        <p>
            <a href="index.php">
                <input type="submit" name="voltar"  id="voltar" value="Voltar para a lista de contatos">
            </a>
        </p>

        <p>
            <strong>Telefone:</strong>
            <?php echo $contato['telefone']; ?>
        </p>

        <p>
            <strong>E-mail: </strong>
            <?php echo $contato['email']; ?>
        </p>

        <p>
            <strong>Data de Nascimento: </strong>
            <?php echo traduz_data_para_exibir($contato['nascimento']); ?>
        </p>

        <p>
            <strong>Favorito: </strong>
            <?php echo traduz_favorito($contato['favorito']); ?>
        </p>
        <hr>
        <h3>Anexos</h3>
        <?php if (count($anexos) > 0): ?>
            <table>
                <tr>
                    <th>Arquivo</th>
                    <th>Opções</th>
                </tr>
                <?php foreach ($anexos as $anexo): ?>
                    <tr>
                        <td><?php echo $anexo['nome']; ?></td>
                        <td>
                            <a href="anexos/<?php echo $anexo['arquivo']; ?>" target="_blank">
                                Download
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <br>
        <?php else: ?>
            <p>Não há anexos para este contato</p>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Novo anexo</legend>
                <input type="hidden" name="contato_id" value="<?php echo $contato['id']; ?>">
                <label>
                    <input type="file" name="anexo">    
                    <?php if ($tem_erros && isset($erros_validacao['anexo'])): ?>
                        <span class="erro">
                            <?php echo $erros_validacao['anexo']; ?>
                        </span>    
                    <?php endif; ?>
                </label>
                <br>
                <div id="botoes">
                    <input type="submit" id="gravar" value="Cadastrar">
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>
