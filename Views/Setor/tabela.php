<table>
    <tr>
        <th>
            <a href="?rota=Setor&sort=id&order=<?php echo $coluna == 'id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                ID <?php echo $coluna == 'id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Setor&sort=descricao&order=<?php echo $coluna == 'descricao' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Setor <?php echo $coluna == 'descricao' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            Opções
        </th>
    </tr>
    <?php foreach ($setores as $setor) : ?>
        <tr>
            <td>
                <?php echo $setor->getId(); ?>
            </td>
            <td>
                <?php echo $setor->getDescricao(); ?>
            </td>
            <td>
                <a class="confirmacao" href="?rota=Setor&edit_id=<?php echo $setor->getId(); ?>">
                    Editar
                </a>
                <a class="confirmacao" href="?rota=Setor&delete_id=<?php echo $setor->getId(); ?>" onclick="return confirmarRemocao()">
                    Remover
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>