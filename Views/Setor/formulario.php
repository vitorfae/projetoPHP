<form class="form-geral" method="post">
    <fieldset>
        <legend>Novo setor</legend>
        <label>
            Descrição:
            <input class="input-geral" type="text" name="descricao" value="<?php echo htmlentities($setor->getDescricao()); ?>" required>
        </label>
        <input type="submit" value="Enviar">
    </fieldset>
</form>