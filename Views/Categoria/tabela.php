<table>
    <tr>
        <th>
            <a href="?rota=Categoria&sort=id&order=<?php echo $coluna == 'id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                ID <?php echo $coluna == 'id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Categoria&sort=descricao&order=<?php echo $coluna == 'descricao' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Descrição <?php echo $coluna == 'descricao' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            Opções
        </th>
    </tr>
    <?php foreach ($categorias as $categoria) : ?>
        <tr>
            <td>
                <?php echo $categoria->getId(); ?>
            </td>
            <td>
                <?php echo $categoria->getDescricao(); ?>
            </td>
            <td>
                <a class="confirmacao" href="?rota=Categoria&edit_id=<?php echo $categoria->getId(); ?>">
                    Editar
                </a>
                <a class="confirmacao" href="?rota=Categoria&delete_id=<?php echo $categoria->getId(); ?>" onclick="return confirmarRemocao()">
                    Remover
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>