<?php
require_once 'Repositories/SetorRepository.php';
require_once 'Repositories/SetorFilialRepository.php';


class FilialService
{
    private $setorRepository;
    private $setorFilialRepository;

    public function __construct(PDO $pdo)
    {
        $this->setorRepository = new SetorRepository($pdo);
        $this->setorFilialRepository = new SetorFilialRepository($pdo);
    }

    public function buscarSetores() : ?array
    {
        return $this->setorRepository->buscar();
    }

    public function buscarSetoresPorFilial(int $filial_id) : ?array
    {
        return $this->setorFilialRepository->setoresPorFilial($filial_id);
    }

    public function atualizarSetoresFilial(int $filial_id, array $setores_selecionados, array $setores_atuais) : void
    {
        if (count($setores_selecionados) == 0 && count($setores_atuais) > 0) 
        {
            foreach ($setores_atuais as $setor_id) 
            {
                $this->setorFilialRepository->remover($filial_id, $setor_id);
            }

            return;
        }

        $setores_a_remover = array_diff($setores_atuais, $setores_selecionados);
        $setores_a_adicionar = array_diff($setores_selecionados, $setores_atuais);

        foreach ($setores_a_remover as $setor_id) 
        {
            $this->setorFilialRepository->remover($filial_id, $setor_id);
        }

        foreach ($setores_a_adicionar as $setor_id) 
        {
            $sf = new SetorFilial();
            $sf->setFilialId($filial_id);
            $sf->setSetorId($setor_id);
            $this->setorFilialRepository->salvar($sf);
        }
    }
}
