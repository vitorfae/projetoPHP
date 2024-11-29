<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <title>Detalhes da Filial</title>
</head>

<body>
    <div class=detalhes-filial>
        <h1>Detalhes</h1>
        <p><strong>ID:</strong> <?php echo $filial->getId(); ?></p>
        <p><strong>Nome:</strong> <?php echo $filial->getNome(); ?></p>
        <p><strong>CNPJ:</strong> <?php echo $filial->getCnpj(); ?></p>
        <p><strong>Estado:</strong> <?php echo $filial->getEstado(); ?></p>
        <p><strong>Cidade:</strong> <?php echo $filial->getCidade(); ?></p>
        <p><strong>Bairro:</strong> <?php echo $filial->getBairro(); ?></p>
        <p><strong>Rua:</strong> <?php echo $filial->getRua(); ?></p>
        <p><strong>Número:</strong> <?php echo $filial->getNumero(); ?></p>
        <label>Setores:</label>
        <form class="form-geral" method="post">
            <select name="setores[]" id="setores" multiple>
                <?php foreach ($setores as $setor): ?>
                    <option value="<?php echo $setor->getId(); ?>"
                        <?php echo $setores_atuais !== null && in_array($setor->getId(), $setores_atuais) ? 'selected' : ''; ?>>
                        <?php echo htmlentities($setor->getDescricao()); ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <button class="input-submit" type="submit">Atualizar</button>
        </form>
        <button onclick="window.location.href='index.php?rota=Filial'">Voltar</button>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag(
            'setores', {
                rounded: false,
                tagColor: {
                    textColor: '#23232e',
                    borderColor: '#23232e',
                    bgColor: '#ffffff'
                }
            }
        )
    </script>
</body>

</html>