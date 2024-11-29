<script>
    const filialSetores = <?php echo json_encode($setores_filial); ?>;

    document.addEventListener('DOMContentLoaded', function () {
        const filialSelect = document.querySelector('select[name="filial"]');
        const setorSelect = document.querySelector('select[name="setor"]');

        const selectedSetorId = "<?php echo isset($ativo) ? $ativo->getSetorId() : ''; ?>";
        updateSetorOptions(filialSelect, setorSelect, selectedSetorId);

        filialSelect.addEventListener('change', function () {
            updateSetorOptions(filialSelect, setorSelect);
        });
    });

    function updateSetorOptions(filialSelect, setorSelect, selectedSetorId = null) {
        const filialId = filialSelect.value;
        setorSelect.innerHTML = '<option value=""></option>';

        if (filialSetores[filialId]) {
            filialSetores[filialId].forEach(setor => {
                const option = document.createElement('option');
                option.value = setor.id;
                option.textContent = setor.descricao;

                if (selectedSetorId && selectedSetorId == setor.id) {
                    option.selected = true;
                }

                setorSelect.appendChild(option);
            });
        }
    }
</script>

<form class="form-geral" method="post">
    <fieldset>
        <legend>Novo ativo</legend>
        <label>
            Descrição:
            <input class="input-geral" type="text" name="descricao" value="<?php echo htmlentities($ativo->getDescricao()); ?>" required>
        </label>

        <label>
            Filial:
            <select name="filial" required>
                <option value=""></option>
                <?php foreach ($formData['filiais'] as $filial) : ?>
                    <option value="<?php echo $filial->getId(); ?>"
                        <?php echo isset($ativo) && $ativo->getFilialId() == $filial->getId() ? 'selected' : ''; ?>>
                        <?php echo $filial->getNome(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Setor:
            <select name="setor" required>
                <option value=""></option>
                <?php foreach ($formData['setores'] as $setor) : ?>
                    <option value="<?php echo $setor->getId(); ?>"
                        <?php echo isset($ativo) && $ativo->getSetorId() == $setor->getId() ? 'selected' : ''; ?>>
                        <?php echo $setor->getDescricao(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Categoria:
            <select name="categoria" required>
                <option value=""></option>
                <?php foreach ($formData['categorias'] as $categoria) : ?>
                    <option value="<?php echo $categoria->getId(); ?>"
                        <?php echo isset($ativo) && $ativo->getCategoriaId() == $categoria->getId() ? 'selected' : ''; ?>>
                        <?php echo $categoria->getDescricao(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Data de Aquisição:
            <input type="date" name="data_aquisicao" value="<?php echo $ativo->getDataAquisicao() ? $ativo->getDataAquisicao()->format('Y-m-d') : ''; ?>" required>
        </label>

        <label>
            Vida Útil (anos):
            <?php if ($tem_erros && isset($erros_validacao['vida_util'])) : ?>
                <span class="erro"><?php echo $erros_validacao['vida_util']; ?></span>
            <?php endif; ?>
            <input type="number" name="vida_util" value="<?php echo $ativo->getVidaUtil() !== 0 ? htmlentities($ativo->getVidaUtil()) : ''; ?>" required>
        </label>

        <label>
            Condição:
            <select name="condicao" required>
                <option value=""></option>
                <option value="1" <?php echo isset($ativo) && $ativo->getCondicao() === 1 ? 'selected' : ''; ?>>Excelente</option>
                <option value="2" <?php echo isset($ativo) && $ativo->getCondicao() === 2 ? 'selected' : ''; ?>>Bom</option>
                <option value="3" <?php echo isset($ativo) && $ativo->getCondicao() === 3 ? 'selected' : ''; ?>>Regular</option>
                <option value="4" <?php echo isset($ativo) && $ativo->getCondicao() === 4 ? 'selected' : ''; ?>>Ruim</option>
                <option value="5" <?php echo isset($ativo) && $ativo->getCondicao() === 5 ? 'selected' : ''; ?>>Péssimo</option>
            </select>
        </label>

        <div>
            <label>Estado do Ativo:</label>
            <label><input type="radio" name="estado_ativo" value="1" <?php echo isset($ativo) && $ativo->getEstadoAtivo() == 1 ? 'checked' : '' ?>> Ativo</label>
            <label><input type="radio" name="estado_ativo" value="0" <?php echo isset($ativo) && $ativo->getEstadoAtivo() == 0 ? 'checked' : '' ?>> Inativo</label>
        </div>

        <label>
            Valor:
            <input type="number" name="valor" step="0.01" value="<?php echo $ativo->getValor() !== 0.0 ? htmlentities($ativo->getValor()) : ''; ?>" required>
        </label>

        <input type="submit" value="Enviar">
    </fieldset>
</form>