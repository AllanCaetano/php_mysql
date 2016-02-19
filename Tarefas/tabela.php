<table>
    <tr>
        <th>Tarefa</th>
        <th>Descrição</th>
        <th>Prazo</th>
        <th>Prioridade</th>
        <th>Concluída</th>
        <th>Opções</th>
    </tr>
    <?php foreach ($tarefas->tarefas as $tarefa): ?>
        <tr>
            <td>
                <a href="tarefa.php?id=<?php echo $tarefa['id']; ?>">
                    <b><?php echo $tarefa['nome']; ?></b>
                </a>
            </td>
            <td><?php echo $tarefa['descricao']; ?></td>
            <td><?php echo traduz_data_para_exibir($tarefa['prazo']); ?></td>
            <td><?php echo traduz_prioridade($tarefa['prioridade']); ?></td>
            <td><?php echo traduz_concluida($tarefa['concluida']); ?></td>
            <td id="opcoes">
                <a href="editar.php?id=<?php echo $tarefa['id']; ?>">
                    <input type="button" name="editar" id="editar" value="Editar">
                </a>
                <a href="duplicar.php?id=<?php echo $tarefa['id']; ?>">
                    <input type="button" name="duplicar" id="duplicar" value="Duplicar">
                </a>
                <a href="remover.php?id=<?php echo $tarefa['id']; ?>">
                    <input type="button" name="remover" id="remover" value="Excluir" onclick="return confirm('DESEJA MESMO EXCLUIR ESSA TAREFA?')">
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
