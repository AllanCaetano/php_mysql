<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador do Estacionamento</title>
    <link rel="stylesheet" href="../assets/css/estilo.css" type="text/css">
</head>
<body>
    <div id="centro">
        <h1>Placa: <?php echo $veiculo['placa']; ?></h1>
        <p>
            <a href="index.php">
                <input type="submit" name="voltar"  id="voltar" value="Voltar para a lista de veiculos">
            </a>
        </p>

        <p>
            <strong>Marca: </strong>
            <?php echo $veiculo['marca']; ?>
        </p>

        <p>
            <strong>Modelo: </strong>
            <?php echo $veiculo['modelo']; ?>
        </p>

        <p>
            <strong>Hora de entrada: </strong>
            <?php echo $veiculo['hora_entrada']; ?>
        </p>

        <p>
            <strong>Hora de saída: </strong>
            <?php echo $veiculo['hora_saida']; ?>
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
            <p>Não há anexos para este veículo</p>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Novo anexo</legend>
                <input type="hidden" name="veiculo_id" value="<?php echo $veiculo['id']; ?>">
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
