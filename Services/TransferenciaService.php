<?php 
require_once 'Repositories/AtivoRepository.php';
require_once 'Repositories/FilialRepository.php';
require_once 'Repositories/SetorRepository.php';
require_once 'Repositories/SetorFilialRepository.php';

class TransferenciaService
{
    private $setorRepository;
    private $ativoRepository;
    private $filialRepository;
    private $setorFilialRepository;

    public function __construct(PDO $pdo)
    {
        $this->setorRepository = new SetorRepository($pdo);
        $this->ativoRepository = new AtivoRepository($pdo);
        $this->filialRepository = new FilialRepository($pdo);
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

    public function transformarAtivos(array $ativos) : array
    {
        $ativos_array = [];

        foreach ($ativos as $ativo)
        {
            $ativos_array[] = [
                'id' => $ativo->getId(),
                'filial_id' => $ativo->getFilialId(),
                'setor_id' => $ativo->getSetorId(),
                'descricao' => $ativo->getDescricao()
            ];
        }

        return $ativos_array;
    }

    public function buscarFiliais() : ?array
    {
        return $this->filialRepository->buscar();
    }

    public function buscarAtivos() : ?array
    {
        return $this->ativoRepository->buscar();
    }

    public function buscarSetores() : ?array
    {
        return $this->setorRepository->buscar();
    }

    public function atualizarAtivo(int $ativo_id, int $filial_id, int $setor_id) : void
    {
        $ativo = $this->ativoRepository->buscar($ativo_id);
        $ativo->setFilialId($filial_id);
        $ativo->setSetorId($setor_id);

        $this->ativoRepository->atualizar($ativo);
    }

    public function nomeFilial(int $filial_id) : string
    {
        return $this->filialRepository->buscar($filial_id)->getNome();
    }

    public function nomeAtivo(int $ativo_id) : string
    {
        return $this->ativoRepository->buscar($ativo_id)->getDescricao();
    }

    public function nomeSetor(int $setor_id) : string
    {
        return $this->setorRepository->buscar($setor_id)->getDescricao();
    }
}
?>