<?php 
permissaoParaVerSite();
require_once 'Repositories/AtivoRepository.php';
require_once __DIR__ . '/../Services/AtivoService.php';
require_once 'Views/Shared/navbar.php';

$ativoService = new AtivoService($pdo);
$ativoRepository = new AtivoRepository($pdo);
$ativo = new Ativo();

$erros_validacao = [];
$tem_erros = false;
$exibir_tabela = true;

// inserindo novo ativo
if (tem_post() && !isset($_GET['edit_id']))
{    
    if (array_key_exists('descricao', $_POST))
    {
        $ativo->setDescricao($_POST['descricao']);
    }

    if (array_key_exists('filial', $_POST))
    {
        $ativo->setFilialId(intval($_POST['filial']));
    }

    if (array_key_exists('setor', $_POST))
    {
        $ativo->setSetorId(intval($_POST['setor']));
    }

    if (array_key_exists('categoria', $_POST))
    {
        $ativo->setCategoriaId(intval($_POST['categoria']));
    }

    if (array_key_exists('data_aquisicao', $_POST))
    {
        $ativo->setDataAquisicao(traduzDataParaBanco($_POST['data_aquisicao']));
    }

    if (array_key_exists('condicao', $_POST) && is_numeric($_POST['condicao']))
    {
        $ativo->setCondicao(intval($_POST['condicao']));
    }

    if (array_key_exists('vida_util', $_POST) && filter_var($_POST['vida_util'], FILTER_VALIDATE_INT) !== false)
    {
        $ativo->setVidaUtil(intval($_POST['vida_util']));
    }
    else
    {
        $tem_erros = true;
        $erros_validacao['vida_util'] = 'Vida útil deve ser um número inteiro representando tempo em anos';
    }
    
    if (array_key_exists('valor', $_POST))
    {
        $ativo->setValor(floatval($_POST['valor']));
    }

    if (!$tem_erros)
    {
        $ativo->setDataCadastro(date('Y-m-d H:i:s'));
        $ativoRepository->salvar($ativo);
        redirecionar('Ativo');
    }
}

// atualizando ativo
if (isset($_GET['edit_id']))
{
    $exibir_tabela = false;
    $id = intval($_GET['edit_id']);
    $ativo = $ativoRepository->buscar($id);

    if (tem_post())
    {
        if (array_key_exists('descricao', $_POST))
        {
            $ativo->setDescricao($_POST['descricao']);
        }
    
        if (array_key_exists('filial', $_POST))
        {
            $ativo->setFilialId(intval($_POST['filial']));
        }
    
        if (array_key_exists('setor', $_POST))
        {
            $ativo->setSetorId(intval($_POST['setor']));
        }
    
        if (array_key_exists('categoria', $_POST))
        {
            $ativo->setCategoriaId(intval($_POST['categoria']));
        }
    
        if (array_key_exists('data_aquisicao', $_POST))
        {
            $ativo->setDataAquisicao(traduzDataParaBanco($_POST['data_aquisicao']));
        }
    
        if (array_key_exists('condicao', $_POST))
        {
            $condicao = $_POST['condicao'];
            if ($condicao !== '')
            {
                $ativo->setCondicao(intval($condicao));
            }
        }
    
        if (array_key_exists('vida_util', $_POST) && filter_var($_POST['vida_util'], FILTER_VALIDATE_INT) !== false)
        {
            $ativo->setVidaUtil(intval($_POST['vida_util']));
        }
        else
        {
            $tem_erros = true;
            $erros_validacao['vida_util'] = 'Vida útil deve ser um número inteiro representando tempo em anos';
        }
        
        if (array_key_exists('valor', $_POST))
        {
            $ativo->setValor(floatval($_POST['valor']));
        }

        if (array_key_exists('estado_ativo', $_POST))
        {
            $ativo->setEstadoAtivo(intval($_POST['estado_ativo']));
        }
        
        if (!$tem_erros)
        {
            $ativoRepository->atualizar($ativo);
            redirecionar('Ativo');
        }
    }

}

// removendo ativo
if (isset($_GET['delete_id']))
{
    $id = intval($_GET['delete_id']);
    $ativoRepository->remover($id);
    redirecionar('Ativo');
}

$coluna = $_GET['sort'] ?? 'id';
$ordem = $_GET['order'] ?? 'asc';

if (!in_array($coluna, ['id', 'descricao', 'filial_id', 'setor_id', 'categoria_id', 'data_cadastro', 'data_aquisicao', 'vida_util', 'condicao', 'estado_ativo', 'valor']))
{
    $coluna = 'id';
}

if (!in_array($ordem, ['asc', 'desc']))
{
    $ordem = 'asc';
}

$formData = $ativoService->dadosParaForm();
$setores_filial = $ativoService->buscarSetoresPorFiliais($formData['filiais']);
$ativos = $ativoRepository->buscar(0, $coluna, $ordem) ?? [];
require __DIR__ . "/../Views/Ativo/template.php";
?>