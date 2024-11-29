<table>
    <tr>
        <th>
            <a href="?rota=Filial&sort=id&order=<?php echo $coluna == 'id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                ID <?php echo $coluna == 'id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Filial&sort=nome_filial&order=<?php echo $coluna == 'nome_filial' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Filial <?php echo $coluna == 'nome_filial' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Filial&sort=cnpj&order=<?php echo $coluna == 'cnpj' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Cnpj <?php echo $coluna == 'cnpj' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Filial&sort=estado&order=<?php echo $coluna == 'estado' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Estado <?php echo $coluna == 'estado' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Filial&sort=cidade&order=<?php echo $coluna == 'cidade' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Cidade <?php echo $coluna == 'cidade' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Filial&sort=bairro&order=<?php echo $coluna == 'bairro' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Bairro <?php echo $coluna == 'bairro' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Filial&sort=rua&order=<?php echo $coluna == 'rua' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Rua <?php echo $coluna == 'rua' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Filial&sort=numero&order=<?php echo $coluna == 'numero' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Número <?php echo $coluna == 'numero' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            Opções
        </th>
    </tr>
    <?php foreach ($filiais as $filial) : ?>
        <tr>
            <td>
                <?php echo $filial->getId(); ?>
            </td>
            <td>
                <?php echo $filial->getNome(); ?>
            </td>
            <td>
                <?php echo $filial->getCnpj(); ?>
            </td>
            <td>
                <?php echo $filial->getEstado(); ?>
            </td>
            <td>
                <?php echo $filial->getCidade(); ?>
            </td>
            <td>
                <?php echo $filial->getBairro(); ?>
            </td>
            <td>
                <?php echo $filial->getRua(); ?>
            </td>
            <td>
                <?php echo $filial->getNumero(); ?>
            </td>
            <td>
                <a class="confirmacao" href="?rota=Filial&edit_id=<?php echo $filial->getId(); ?>">
                    Editar
                </a>
                <a class="confirmacao" href="?rota=Filial&delete_id=<?php echo $filial->getId(); ?>" onclick="return confirmarRemocao()">
                    Remover
                </a>
                <a class="confirmacao" href="?rota=Filial&detail_id=<?php echo $filial->getId(); ?>">
                    Detalhes
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>