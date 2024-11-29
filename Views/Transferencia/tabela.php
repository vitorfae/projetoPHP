<table>
    <tr>
        <th>
            <a href="?rota=Transferencia&sort=id&order=<?php echo $coluna == 'id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                ID <?php echo $coluna == 'id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Transferencia&sort=ativo_id&order=<?php echo $coluna == 'ativo_id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Ativo <?php echo $coluna == 'ativo_id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Transferencia&sort=filial_origem_id&order=<?php echo $coluna == 'filial_origem_id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Filial Origem <?php echo $coluna == 'filial_origem_id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Transferencia&sort=setor_origem_id&order=<?php echo $coluna == 'setor_origem_id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Setor Origem <?php echo $coluna == 'setor_origem_id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Transferencia&sort=filial_destino_id&order=<?php echo $coluna == 'filial_destino_id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Filial Destino <?php echo $coluna == 'filial_destino_id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Transferencia&sort=setor_destino_id&order=<?php echo $coluna == 'setor_destino_id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Setor Destino <?php echo $coluna == 'setor_destino_id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Transferencia&sort=data_transferencia&order=<?php echo $coluna == 'data_transferencia' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Data Transferência <?php echo $coluna == 'data_transferencia' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            Opções
        </th>
    </tr>
    <?php foreach ($transferencias as $transf) : ?>
        <tr>
            <td>
                <?php echo $transf->getId(); ?>
            </td>
            <td>
                <?php echo $transfService->nomeAtivo($transf->getIdAtivo()); ?>
            </td>
            <td>
                <?php echo $transfService->nomeFilial($transf->getIdFilialOrigem()); ?>
            </td>
            <td>
                <?php echo $transfService->nomeSetor($transf->getIdSetorOrigem()); ?>
            </td>
            <td>
                <?php echo $transfService->nomeFilial($transf->getIdFilialDestino()); ?>
            </td>
            <td>
                <?php echo $transfService->nomeSetor($transf->getIdSetorDestino()); ?>
            </td>
            <td>
                <?php echo traduzDataParaExibir($transf->getData()); ?>
            </td>
            <td>
                <a class="confirmacao" href="?rota=Transferencia&edit_id=<?php echo $transf->getId(); ?>">
                    Editar
                </a>
                <a class="confirmacao" href="?rota=Transferencia&delete_id=<?php echo $transf->getId(); ?>" onclick="return confirmarRemocao()">
                    Remover
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>