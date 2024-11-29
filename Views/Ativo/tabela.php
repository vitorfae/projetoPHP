<table>
    <tr>
        <th>
            <a href="?rota=Ativo&sort=id&order=<?php echo $coluna == 'id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                ID <?php echo $coluna == 'id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Ativo&sort=descricao&order=<?php echo $coluna == 'descricao' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Ativo <?php echo $coluna == 'descricao' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Ativo&sort=filial_id&order=<?php echo $coluna == 'filial_id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Filial <?php echo $coluna == 'filial_id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Ativo&sort=setor_id&order=<?php echo $coluna == 'setor_id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Setor <?php echo $coluna == 'setor_id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Ativo&sort=categoria_id&order=<?php echo $coluna == 'categoria_id' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Categoria <?php echo $coluna == 'categoria_id' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Ativo&sort=data_cadastro&order=<?php echo $coluna == 'data_cadastro' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Data Cadastro <?php echo $coluna == 'data_cadastro' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Ativo&sort=data_aquisicao&order=<?php echo $coluna == 'data_aquisicao' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Data Aquisição <?php echo $coluna == 'data_aquisicao' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Ativo&sort=vida_util&order=<?php echo $coluna == 'vida_util' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Vida Útil <?php echo $coluna == 'vida_util' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Ativo&sort=condicao&order=<?php echo $coluna == 'condicao' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Condição <?php echo $coluna == 'condicao' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Ativo&sort=estado_ativo&order=<?php echo $coluna == 'estado_ativo' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Estado Ativo <?php echo $coluna == 'estado_ativo' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            <a href="?rota=Ativo&sort=valor&order=<?php echo $coluna == 'valor' && $ordem == 'asc' ? 'desc' : 'asc'; ?>">
                Valor <?php echo $coluna == 'valor' ? ($ordem == 'asc' ? '▲' : '▼') : ''; ?>
            </a>
        </th>
        <th>
            Opções
        </th>
    </tr>
    <?php foreach ($ativos as $ativo) : ?>
        <tr>
            <td>
                <?php echo $ativo->getId(); ?>
            </td>
            <td>
                <?php echo $ativo->getDescricao(); ?>
            </td>
            <td>
                <?php echo $ativoService->nomeFilial($ativo->getFilialId()); ?>
            </td>
            <td>
                <?php echo $ativoService->nomeSetor($ativo->getSetorId()); ?>
            </td>
            <td>
                <?php echo $ativoService->nomeCategoria($ativo->getCategoriaId()); ?>
            </td>
            <td>
                <?php echo traduzDataParaExibir($ativo->getDataCadastro()); ?>
            </td>
            <td>
                <?php echo traduzDataParaExibir($ativo->getDataAquisicao()); ?>
            </td>
            <td>
                <?php echo $ativo->getVidaUtil() > 1 ? $ativo->getVidaUtil() . ' anos' : $ativo->getVidaUtil() . ' ano'; ?>
            </td>
            <td>
                <?php echo traduzCondicaoParaExibir($ativo->getCondicao()); ?>
            </td>
            <td>
                <?php echo $ativo->getEstadoAtivo() == 1 ? 'Ativo' : 'Baixado'; ?>
            </td>
            <td>
                <?php echo 'R$ ' . number_format($ativo->getValor(), 2, ',', '.'); ?>
            </td>
            <td>
                <a class="confirmacao" href="?rota=ativo&edit_id=<?php echo $ativo->getId(); ?>">
                    Editar
                </a>
                <a class="confirmacao" href="?rota=ativo&delete_id=<?php echo $ativo->getId(); ?>" onclick="return confirmarRemocao()">
                    Remover
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>