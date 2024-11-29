<?php 
permissaoParaVerSite();
require_once 'Repositories/SetorRepository.php';
require_once 'Views/Shared/navbar.php';

$setorRepository = new SetorRepository($pdo);
$setor = new Setor();

$exibir_tabela = true;

// inserindo novo setor
if (tem_post() && !isset($_GET['edit_id']))
{
    if (array_key_exists('descricao', $_POST))
    {
        $setor->setDescricao($_POST['descricao']);
    }

    $setorRepository->salvar($setor);
    redirecionar('Setor');
}

// atualizando setor
if (isset($_GET['edit_id']))
{
    $id = intval($_GET['edit_id']);
    $setor = $setorRepository->buscar($id);
    $exibir_tabela = false;

    if (tem_post())
    {
        if (array_key_exists('descricao', $_POST))
        {
            $setor->setDescricao($_POST['descricao']);
        }

        $setorRepository->atualizar($setor);
        redirecionar('Setor');
    }
}

// removendo setor
if (isset($_GET['delete_id']))
{
    $id = intval($_GET['delete_id']);
    $setorRepository->remover($id);
    redirecionar('Setor');
}

$coluna = $_GET['sort'] ?? 'id';
$ordem = $_GET['order'] ?? 'asc';

if (!in_array($coluna, ['id', 'descricao']))
{
    $coluna = 'id';
}

if (!in_array($ordem, ['asc', 'desc']))
{
    $ordem = 'asc';
}

$setores = $setorRepository->buscar(0, $coluna, $ordem) ?? [];
require __DIR__ . "/../Views/Setor/template.php";
?>