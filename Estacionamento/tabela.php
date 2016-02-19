<table>
    <tr>
        <th>Placa</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Hora entrada</th>
        <th>Hora saída</th>
        <th>Opções</th>
    </tr>
    <?php foreach ($veiculos->veiculos as $veiculo): ?>
        <tr>
            <td>
                <a href="veiculo.php?id=<?php echo $veiculo['id']; ?>">
                    <b><?php echo $veiculo['placa']; ?></b>
                </a>
            </td>
            <td><?php echo $veiculo['marca']; ?></td>
            <td><?php echo $veiculo['modelo']; ?></td>
            <td><?php echo $veiculo['hora_entrada']; ?></td>
            <td><?php echo $veiculo['hora_saida']; ?></td>
            <td id="opcoes">
                <a href="editar.php?id=<?php echo $veiculo['id']; ?>">
                    <input type="submit" id="editar" name="editar" value="Editar">
                </a>     
                <a href="duplicar.php?id=<?php echo $veiculo['id']; ?>">
                    <input type="submit" id="duplicar" name="duplicar" value="Duplicar">
                </a>     
                <a href="remover.php?id=<?php echo $veiculo['id']; ?>">
                    <input type="submit" id="remover" name="remover" value="Excluir" onclick="return confirm('DESEJA MESMO EXCLUIR ESSE VEÍCULO?')">
                </a>     
            </td>
        </tr>
    <?php endforeach; ?>
</table>