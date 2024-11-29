<html>

<head>
    <meta charset="utf-8" />
    <title>Categorias</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>

<body>
    <div id="bloco_principal">
        <?php include('formulario.php'); ?>

        <?php if ($exibir_tabela) : ?>
            <?php include('tabela.php'); ?>
        <?php endif; ?>
    </div>
</body>

</html>