<form class="form-geral" method="post">
    <fieldset>
        <legend>Nova filial</legend>
        <label>
            Nome:
            <input class="input-geral" type="text" name="nome" value="<?php echo htmlentities($filial->getNome()); ?>" required>
        </label>
        <label>
            CNPJ:
            <?php if ($tem_erros && isset($erros_validacao['cnpj'])) : ?>
                <span class="erro"><?php echo $erros_validacao['cnpj']; ?></span>
            <?php endif; ?>
            <input class="input-geral" type="text" name="cnpj" value="<?php echo htmlentities($filial->getCnpj()); ?>" required>
        </label>
        <label>
            Estado (UF):
            <?php if ($tem_erros && isset($erros_validacao['estado'])) : ?>
                <span class="erro"><?php echo $erros_validacao['estado']; ?></span>
            <?php endif; ?>
            <input class="input-geral" type="text" name="estado" value="<?php echo htmlentities($filial->getEstado()); ?>" required>
        </label>
        <label>
            Cidade:
            <input class="input-geral" type="text" name="cidade" value="<?php echo htmlentities($filial->getCidade()); ?>" required>
        </label>
        <label>
            Bairro:
            <input class="input-geral" type="text" name="bairro" value="<?php echo htmlentities($filial->getBairro()); ?>" required>
        </label>
        <label>
            Rua:
            <input class="input-geral" type="text" name="rua" value="<?php echo htmlentities($filial->getRua()); ?>" required>
        </label>
        <label>
            Número:
            <input class="input-geral" type="text" name="num" value="<?php echo $filial->getNumero() !== 0 ? htmlentities($filial->getNumero()) : ''; ?>">
        </label>
        <input type="submit" value="Enviar">
    </fieldset>
</form>