<script>
    const filialSetores = <?php echo json_encode($setores_filial); ?>;

    function updateSetorOptions(filialSelect, setorSelect, selectedSetorId) {
        const filialId = filialSelect.value;
        setorSelect.innerHTML = '<option value=""></option>';

        if (filialSetores[filialId]) {
            filialSetores[filialId].forEach(setor => {
                const option = document.createElement('option');
                option.value = setor.id;
                option.textContent = setor.descricao;

                if (selectedSetorId && selectedSetorId === setor.id) {
                    option.selected = true;
                }

                setorSelect.appendChild(option);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const filialOrigemSelect = document.querySelector('select[name="filial_origem_id"]');
        const setorOrigemSelect = document.querySelector('select[name="setor_origem_id"]');
        const filialDestinoSelect = document.querySelector('select[name="filial_destino_id"]');
        const setorDestinoSelect = document.querySelector('select[name="setor_destino_id"]');

        updateSetorOptions(filialOrigemSelect, setorOrigemSelect, <?php echo isset($transf) ? $transf->getIdSetorOrigem() : 'null'; ?>);
        updateSetorOptions(filialDestinoSelect, setorDestinoSelect, <?php echo isset($transf) ? $transf->getIdSetorDestino() : 'null'; ?>);

        filialOrigemSelect.addEventListener('change', function() {
            updateSetorOptions(filialOrigemSelect, setorOrigemSelect);
        });

        filialDestinoSelect.addEventListener('change', function() {
            updateSetorOptions(filialDestinoSelect, setorDestinoSelect);
        });

        const ativoSelect = document.querySelector('select[name="ativo_id"]');
        const filialOrigemSelectForAtivo = document.querySelector('select[name="filial_origem_id"]');
        const setorOrigemSelectForAtivo = document.querySelector('select[name="setor_origem_id"]');

        const ativos = <?php echo json_encode($transfService->transformarAtivos($ativos)); ?>;

        function updateFilialAndSetor(ativoId) {
            const ativo = ativos.find(a => a.id === ativoId);

            if (ativo) {
                const filialId = ativo.filial_id;
                const setorId = ativo.setor_id;

                filialOrigemSelectForAtivo.value = filialId;
                updateSetorOptions(filialOrigemSelectForAtivo, setorOrigemSelectForAtivo, setorId);
            }
        }

        ativoSelect.addEventListener('change', function() {
            const ativoId = parseInt(ativoSelect.value);
            updateFilialAndSetor(ativoId);
        });

        <?php if (isset($transf) && $transf->getIdAtivo()): ?>
            updateFilialAndSetor(<?php echo $transf->getIdAtivo(); ?>);
        <?php endif; ?>
    });
</script>

<form class="form-geral" method="post">
    <fieldset>
        <legend>Nova transferência</legend>
        <label>
            Ativo:
            <select name="ativo_id" required>
                <option value=""></option>
                <?php foreach ($ativos as $ativo): ?>
                    <option value="<?php echo $ativo->getId(); ?>"
                        <?php echo isset($transf) && $transf->getIdAtivo() == $ativo->getId() ? 'selected' : '' ?>>
                        <?php echo $ativo->getDescricao(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Filial de origem:
            <select name="filial_origem_id" required>
                <option value=""></option>
                <?php foreach ($filiais as $filial): ?>
                    <option value="<?php echo $filial->getId(); ?>"
                        <?php echo isset($transf) && $transf->getIdFilialOrigem() == $filial->getId() ? 'selected' : '' ?>>
                        <?php echo $filial->getNome(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Setor de origem:
            <select name="setor_origem_id" required>
                <option value=""></option>
                <?php foreach ($setores as $setor): ?>
                    <option value="<?php echo $setor->getId(); ?>"
                        <?php echo isset($transf) && $transf->getIdSetorOrigem() == $setor->getId() ? 'selected' : '' ?>>
                        <?php echo $setor->getDescricao(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Filial de destino:
            <select name="filial_destino_id" required>
                <option value=""></option>
                <?php foreach ($filiais as $filial): ?>
                    <option value="<?php echo $filial->getId(); ?>"
                        <?php echo isset($transf) && $transf->getIdFilialDestino() == $filial->getId() ? 'selected' : '' ?>>
                        <?php echo $filial->getNome(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Setor de destino:
            <select name="setor_destino_id" required>
                <option value=""></option>
                <?php foreach ($setores as $setor): ?>
                    <option value="<?php echo $setor->getId(); ?>"
                        <?php echo isset($transf) && $transf->getIdSetorDestino() == $setor->getId() ? 'selected' : '' ?>>
                        <?php echo $setor->getDescricao(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            Data da transferência:
            <input type="date" name="data" value="<?php echo $transf->getData() ? $transf->getData()->format('Y-m-d') : ''; ?>" required>
        </label>

        <input type="submit" value="Enviar">
    </fieldset>
</form>