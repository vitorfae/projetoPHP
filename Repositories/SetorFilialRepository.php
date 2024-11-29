<?php 
require_once __DIR__ . '/../Models/SetorFilial.php';

class SetorFilialRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    public function salvar(SetorFilial $sf) : void
    {
        $setor_id = $sf->getSetorId();
        $filial_id = $sf->getFilialId();

        $query = "
            INSERT INTO SETOR_FILIAL (SETOR_ID, FILIAL_ID)
            VALUES (:setor_id, :filial_id)
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':setor_id' => $setor_id,
            ':filial_id' => $filial_id
        ]);
    }

    public function atualizar(SetorFilial $sf) : void
    {
        $id = $sf->getId();
        $setor_id = $sf->getSetorId();
        $filial_id = $sf->getFilialId();

        $query = "
            UPDATE SETOR_FILIAL SET
                SETOR_ID = :setor_id,
                FILIAL_ID = :filial_id
            WHERE ID = :id
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':setor_id' => $setor_id,
            ':filial_id' => $filial_id,
            ':id' => $id 
        ]);
    }

    public function remover(int $filial_id, int $setor_id) : bool
    {
        $query = "DELETE FROM SETOR_FILIAL WHERE filial_id = :id1 AND setor_id = :id2";

        $stmt = $this->bd->prepare($query);
        return $stmt->execute([':id1' => $filial_id, 'id2' => $setor_id]);
    }

    public function removerPorFilial(int $filial_id) : bool
    {
        $query = "DELETE FROM SETOR_FILIAL WHERE filial_id = :id1";

        $stmt = $this->bd->prepare($query);
        return $stmt->execute([':id1' => $filial_id]);
    }

    public function removerPorSetor(int $setor_id) : bool
    {
        $query = "DELETE FROM SETOR_FILIAL WHERE setor_id = :id1";

        $stmt = $this->bd->prepare($query);
        return $stmt->execute([':id1' => $setor_id]);
    }

    public function buscar(int $filial_id = 0) : ?array
    {
        if ($filial_id > 0)
        {
            return $this->buscarPorFilial($filial_id);
        }
        else
        {
            return $this->buscarTudo();
        }
    }

    public function setoresPorFilial($filial_id) : ?array
    {
        $query = "SELECT * FROM SETOR_FILIAL WHERE FILIAL_ID = :filial_id";
        $stmt = $this->bd->prepare($query);
        $stmt->execute([':filial_id' => $filial_id]);

        $setores_filial = [];

        while($setor_filial = $stmt->fetchObject('SetorFilial'))
        {
            $setores_filial[] = $setor_filial->getSetorId();
        }

        return count($setores_filial) > 0 ? $setores_filial : null;  
    }

    private function buscarPorFilial(int $filial_id) : ?array
    {
        $query = "SELECT * FROM SETOR_FILIAL WHERE FILIAL_ID = :filial_id";
        $stmt = $this->bd->prepare($query);
        $stmt->execute([':filial_id' => $filial_id]);

        $setores_filial = [];

        while($setor_filial = $stmt->fetchObject('SetorFilial'))
        {
            $setores_filial[] = $setor_filial;
        }

        return count($setores_filial) > 0 ? $setores_filial : null;
    }

    private function buscarTudo() : ?array
    {
        $query = "SELECT * FROM SETOR_FILIAL ORDER BY FILIAL_ID ASC";
        $stmt = $this->bd->query($query);

        $setores_filial = [];

        while($setor_filial = $stmt->fetchObject('SetorFilial'))
        {
            $setores_filial[] = $setor_filial;
        }

        return count($setores_filial) > 0 ? $setores_filial : null;
    }
}
?>