<table>
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>E-mail</th>
        <th>Nascimento</th>
        <th>Favorito</th>
        <th>Opções</th>
    </tr>
    <?php foreach ($contatos->contatos as $contato): ?>
        <tr>
            <td>
                <a href="contato.php?id=<?php echo $contato['id']; ?>">
                    <b><?php echo $contato['nome']; ?></b>
                </a>
            </td>    
            <td><?php echo $contato['telefone']; ?></td>
            <td><?php echo $contato['email']; ?></td>
            <td><?php echo traduz_data_para_exibir($contato['nascimento']); ?></td>
            <td><?php echo traduz_favorito($contato['favorito']); ?></td>
            <td id="opcoes">
                <a href="editar.php?id=<?php echo $contato['id'] ?>">
                    <input type="submit" id="editar" name="editar" value="Editar">
                </a>
                <a href="duplicar.php?id=<?php echo $contato['id'] ?>">
                    <input type="submit" id="duplicar" name="duplicar" value="Duplicar">
                </a>
                <a href="remover.php?id=<?php echo $contato['id'] ?>">
                    <input type="submit" id="remover" name="remover" value="Excluir" onclick="return confirm('DESEJA MESMO EXCLUIR ESSE CONTATO?')">
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>