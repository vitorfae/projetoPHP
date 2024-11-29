<?php 
permissaoParaVerSite();
require_once 'Repositories/FilialRepository.php';
require_once 'Services/FilialService.php';
require_once 'Views/Shared/navbar.php';

$filialService = new FilialService($pdo);
$filialRepository = new FilialRepository($pdo);
$filial = new Filial();

$tem_erros = false;
$erros_validacao = [];

$exibir_tabela = true;

// inserindo nova filial
if (tem_post() && !isset($_GET['edit_id']) && !isset($_GET['detail_id']))
{
    if (array_key_exists('nome', $_POST))
    {
        $filial->setNome($_POST['nome']);
    }

    if (array_key_exists('cnpj', $_POST) && strlen($_POST['cnpj']) == 14)
    {
        $filial->setCnpj($_POST['cnpj']);
    }
    else
    {
        $tem_erros = true;
        $erros_validacao['cnpj'] = 'O Cnpj deve conter 14 caracteres';
    }

    if (array_key_exists('estado', $_POST) && strlen($_POST['estado']) == 2)
    {
        $filial->setEstado($_POST['estado']);
    }
    else
    {
        $tem_erros = true;
        $erros_validacao['estado'] = 'O estado deve estar em sigla';
    }

    if (array_key_exists('cidade', $_POST))
    {
        $filial->setCidade($_POST['cidade']);
    }

    if (array_key_exists('bairro', $_POST))
    {
        $filial->setBairro($_POST['bairro']);
    }

    if (array_key_exists('rua', $_POST))
    {
        $filial->setRua($_POST['rua']);
    }
    
    if (array_key_exists('num', $_POST))
    {
        $filial->setNumero($_POST['num']);
    }

    if (!$tem_erros)
    {
        $filialRepository->salvar($filial);
        redirecionar('Filial');
    }       
}

// atualizando filial
if (isset($_GET['edit_id']))
{
    $exibir_tabela = false;
    $id = intval($_GET['edit_id']);
    $filial = $filialRepository->buscar($id);
    if (tem_post())
    {
        if (array_key_exists('nome', $_POST))
        {
            $filial->setNome($_POST['nome']);
        }
    
        if (array_key_exists('cnpj', $_POST) && strlen($_POST['cnpj']) == 14)
        {
            $filial->setCnpj($_POST['cnpj']);
        }
        else
        {
            $tem_erros = true;
            $erros_validacao['cnpj'] = 'O Cnpj deve conter 14 caracteres';
        }
    
        if (array_key_exists('estado', $_POST) && strlen($_POST['estado']) == 2)
        {
            $filial->setEstado($_POST['estado']);
        }
        else
        {
            $tem_erros = true;
            $erros_validacao['estado'] = 'O estado deve estar em sigla';
        }
    
        if (array_key_exists('cidade', $_POST))
        {
            $filial->setCidade($_POST['cidade']);
        }
    
        if (array_key_exists('bairro', $_POST))
        {
            $filial->setBairro($_POST['bairro']);
        }
    
        if (array_key_exists('rua', $_POST))
        {
            $filial->setRua($_POST['rua']);
        }
        
        if (array_key_exists('num', $_POST))
        {
            $filial->setNumero($_POST['num']);
        }
        
        if (!$tem_erros)
        {
            $filialRepository->atualizar($filial);
            redirecionar('Filial');
        }
    }
}

// removendo filial
if (isset($_GET['delete_id']))
{
    $id = intval($_GET['delete_id']);
    $filialRepository->remover($id);
    redirecionar('Filial');
}

// detalhes da filial
if (isset($_GET['detail_id']))
{
    $id = intval($_GET['detail_id']);
    $filial = $filialRepository->buscar($id);
    $setores = $filialService->buscarSetores();
    $setores_atuais = $filialService->buscarSetoresPorFilial($id) ?? [];
    require __DIR__ . "/../Views/Filial/filial_template.php";

    if (tem_post())
    {
        $setores_selecionados = isset($_POST['setores']) ? $_POST['setores'] : [];
        $filialService->atualizarSetoresFilial($id, $setores_selecionados, $setores_atuais);

        redirecionar("Filial&detail_id={$id}");
    }

    die();
}

$coluna = $_GET['sort'] ?? 'id';
$ordem = $_GET['order'] ?? 'asc';

if (!in_array($coluna, ['id', 'nome_filial', 'cnpj', 'estado', 'cidade', 'bairro', 'rua', 'numero']))
{
    $coluna = 'id';
}

if (!in_array($ordem, ['asc', 'desc']))
{
    $ordem = 'asc';
}

$filiais = $filialRepository->buscar(0, $coluna, $ordem) ?? [];
require __DIR__ . "/../Views/Filial/template.php";
?>