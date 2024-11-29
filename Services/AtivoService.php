<?php 
require_once 'Repositories/SetorRepository.php';
require_once 'Repositories/CategoriaRepository.php';
require_once 'Repositories/FilialRepository.php';
require_once 'Repositories/SetorFilialRepository.php';

class AtivoService
{
    private $filialRepository;
    private $categoriaRepository;
    private $setorRepository;
    private $setorFilialRepository;

    public function __construct($pdo)
    {
        $this->filialRepository = new FilialRepository($pdo);
        $this->categoriaRepository = new CategoriaRepository($pdo);
        $this->setorRepository = new SetorRepository($pdo);
        $this->setorFilialRepository = new SetorFilialRepository($pdo);
    }

    public function buscarSetoresPorFiliais(array $filiais) : array
    {
        $setores_filial = [];

        foreach ($filiais as $filial)
        {
            $setores_ids = $this->setorFilialRepository->setoresPorFilial($filial->getId()) ?? [];

            $setores_completos = [];

            foreach ($setores_ids as $setor_id)
            {
                $setor = $this->setorRepository->buscar($setor_id);
                $setores_completos[] = [
                    'id' => $setor->getId(),
                    'descricao' => $setor->getDescricao()
                ];
            }

            $setores_filial[$filial->getId()] = $setores_completos;
        }

        return $setores_filial;
    }

    public function dadosParaForm() : array
    {
        $filiais = $this->filialRepository->buscar() ?? [];
        $categorias = $this->categoriaRepository->buscar() ?? [];
        $setores = $this->setorRepository->buscar() ?? [];

        return [
            'filiais' => $filiais,
            'categorias' => $categorias,
            'setores' => $setores
        ];
    }

    public function nomeFilial(int $id) : string
    {
        return $this->filialRepository->buscar($id)->getNome();
    }

    public function nomeCategoria(int $id) : string
    {
        return $this->categoriaRepository->buscar($id)->getDescricao();
    }

    public function nomeSetor(int $id) : string
    {
        return $this->setorRepository->buscar($id)->getDescricao();
    }
}
?>