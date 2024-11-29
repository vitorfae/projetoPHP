<?php 
permissaoParaVerSite();
require_once 'Repositories/TransferenciaRepository.php';
require_once 'Services/TransferenciaService.php';
require_once 'Views/Shared/navbar.php';

$transfService = new TransferenciaService($pdo);
$transfRepository = new TransferenciaRepository($pdo);
$transf = new Transferencia();

$exibir_tabela = true;

// inserindo nova transferencia
if (tem_post() && !isset($_GET['edit_id']))
{
    if (isset($_POST['ativo_id']))
    {
        $transf->setIdAtivo(intval($_POST['ativo_id']));
    }

    if (isset($_POST['filial_origem_id']))
    {
        $transf->setIdFilialOrigem(intval($_POST['filial_origem_id']));
    }

    if (isset($_POST['setor_origem_id']))
    {
        $transf->setIdSetorOrigem(intval($_POST['setor_origem_id']));
    }

    if (isset($_POST['filial_destino_id']))
    {
        $transf->setIdFilialDestino(intval($_POST['filial_destino_id']));
    }

    if (isset($_POST['setor_destino_id']))
    {
        $transf->setIdSetorDestino(intval($_POST['setor_destino_id']));
    }

    if (isset($_POST['data']))
    {
        $transf->setData($_POST['data']);
    }

    $transfRepository->salvar($transf);
    $transfService->atualizarAtivo($transf->getIdAtivo(), $transf->getIdFilialDestino(), $transf->getIdSetorDestino());
    redirecionar('Transferencia');
}

// editando transferencia
if (isset($_GET['edit_id']))
{
    $id = intval($_GET['edit_id']);
    $transf = $transfRepository->buscar($id);
    $exibir_tabela = false;

    if (tem_post())
    {
        if (isset($_POST['ativo_id']))
        {
            $transf->setIdAtivo(intval($_POST['ativo_id']));
        }
    
        if (isset($_POST['filial_origem_id']))
        {
            $transf->setIdFilialOrigem(intval($_POST['filial_origem_id']));
        }
    
        if (isset($_POST['setor_origem_id']))
        {
            $transf->setIdSetorOrigem(intval($_POST['setor_origem_id']));
        }
    
        if (isset($_POST['filial_destino_id']))
        {
            $transf->setIdFilialDestino(intval($_POST['filial_destino_id']));
        }
    
        if (isset($_POST['setor_destino_id']))
        {
            $transf->setIdSetorDestino(intval($_POST['setor_destino_id']));
        }
    
        if (isset($_POST['data']))
        {
            $transf->setData($_POST['data']);
        }

        $transfRepository->atualizar($transf);
        $transfService->atualizarAtivo($transf->getIdAtivo(), $transf->getIdFilialDestino(), $transf->getIdSetorDestino());
        redirecionar('Transferencia');
    }
}

// removendo transferencia
if (isset($_GET['delete_id']))
{
    $id = intval($_GET['delete_id']);
    $transf = $transfRepository->buscar($id);
    $transfService->atualizarAtivo($transf->getIdAtivo(), $transf->getIdFilialOrigem(), $transf->getIdSetorOrigem());
    $transfRepository->remover($id);
    redirecionar('Transferencia');
}

$coluna = $_GET['sort'] ?? 'id';
$ordem = $_GET['order'] ?? 'asc';

if (!in_array($coluna, ['id', 'ativo_id', 'filial_origem_id', 'setor_origem_id', 'filial_destino_id', 'setor_destino_id', 'data_transferencia']))
{
    $coluna = 'id';
}

if (!in_array($ordem, ['asc', 'desc']))
{
    $ordem = 'asc';
}

$ativos = $transfService->buscarAtivos() ?? [];
$setores = $transfService->buscarSetores() ?? [];
$filiais = $transfService->buscarFiliais() ?? [];
$setores_filial = $transfService->buscarSetoresPorFiliais($filiais);
$transferencias = $transfRepository->buscar(0, $coluna, $ordem) ?? [];
require __DIR__ . '/../Views/Transferencia/template.php';
?>