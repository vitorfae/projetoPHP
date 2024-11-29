<?php 
function convertToDateTime(DateTime|string $data): DateTime
{
    return is_string($data) ? new DateTime($data) : $data;
}

function redirecionar(string $rota) : void
{
    header("Location: index.php?rota={$rota}");
    die();
}

function tem_post() : bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function traduzDataParaExibir(DateTime|string $data) : string
{
    if (is_object($data) && get_class($data) == "DateTime") {
        return $data->format("d/m/Y");
    }

    if ($data == "" OR $data == "0000-00-00") {
        return "";
    }

    $dados = explode("-", $data);

    if (count($dados) != 3) {
        return $data;
    }

    $data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

    return $data_exibir;
}

function traduzCondicaoParaExibir(int $condicao) : ?string
{
    switch ($condicao)
    {
        case 1:
            return 'Excelente';
            break;
        case 2:
            return 'Bom';
            break;
        case 3:
            return 'Regular';
            break;
        case 4:
            return 'Ruim';
            break;
        case 5:
            return 'Péssimo';
            break;
    }

    return null;
}

function traduzDataParaBanco(string $data) : string
{
    if ($data == "") {
        return "";
    }

    $dados = explode("/", $data);

    if (count($dados) != 3) {
        return $data;
    }

    $data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

    return $data_mysql;
}

function permissaoParaVerSite() : void
{
    if (!isset($_SESSION))
    {
        session_start();
    }

    if (!isset($_SESSION['id']))
    {
        redirecionar('Login');
    }
}
?>