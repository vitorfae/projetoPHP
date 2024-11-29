<?php 
require_once __DIR__ . '/../Models/transferencia.php';

class TransferenciaRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    public function salvar(Transferencia $transf) : void
    {
        $id_ativo = $transf->getIdAtivo();
        $id_filial_origem = $transf->getIdFilialOrigem();
        $id_filial_dest = $transf->getIdFilialDestino();
        $id_setor_origem = $transf->getIdSetorOrigem();
        $id_setor_dest = $transf->getIdSetorDestino();
        $data_transf = $transf->getData();

        if (is_object($data_transf))
        {
            $data_transf = $data_transf->format('Y-m-d H:i:s');
        }

        $query = "
            INSERT INTO TRANSFERENCIA (ATIVO_ID, FILIAL_ORIGEM_ID, SETOR_ORIGEM_ID, FILIAL_DESTINO_ID, SETOR_DESTINO_ID, DATA_TRANSFERENCIA)
            VALUES
            (
                :id_ativo,
                :id_filial_origem,
                :id_setor_origem,
                :id_filial_dest,
                :id_setor_dest,
                :data_transf
            )
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':id_ativo' => $id_ativo,
            ':id_filial_origem' => $id_filial_origem,
            ':id_setor_origem' => $id_setor_origem,
            ':id_filial_dest' => $id_filial_dest,
            ':id_setor_dest' => $id_setor_dest,
            ':data_transf' => $data_transf 
        ]);
    }

    public function atualizar(Transferencia $transf) : void
    {
        $id = $transf->getId();
        $id_ativo = $transf->getIdAtivo();
        $id_filial_origem = $transf->getIdFilialOrigem();
        $id_filial_dest = $transf->getIdFilialDestino();
        $id_setor_origem = $transf->getIdSetorOrigem();
        $id_setor_dest = $transf->getIdSetorDestino();
        $data_transf = $transf->getData();

        if (is_object($data_transf))
        {
            $data_transf = $data_transf->format('Y-m-d H:i:s');
        }

        $query = "
            UPDATE TRANSFERENCIA SET
               ATIVO_ID = :id_ativo,
               FILIAL_ORIGEM_ID = :id_filial_origem,
               SETOR_ORIGEM_ID = :id_setor_origem,
               FILIAL_DESTINO_ID = :id_filial_dest,
               SETOR_DESTINO_ID = :id_setor_dest,
               DATA_TRANSFERENCIA = :data_transf
            WHERE ID = :id
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':id_ativo' => $id_ativo,
            ':id_filial_origem' => $id_filial_origem,
            ':id_setor_origem' => $id_setor_origem,
            ':id_filial_dest' => $id_filial_dest,
            ':id_setor_dest' => $id_setor_dest,
            ':data_transf' => $data_transf,
            ':id' => $id
        ]);
    }

    public function remover(int $id) : bool
    {
        $query = "DELETE FROM TRANSFERENCIA WHERE ID = :id";

        $stmt = $this->bd->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function buscar(int $id = 0, string $coluna = 'id', string $ordem = 'asc') : Transferencia|array|null
    {
        if ($id > 0)
        {
            return $this->buscarTransf($id);
        }
        else
        {
            return $this->buscarTudo($coluna, $ordem);
        }
    }

    private function buscarTransf(int $id) : ?Transferencia
    {
        $query = "SELECT * FROM TRANSFERENCIA WHERE ID = :id";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([':id' => $id]);

        $transf = $stmt->fetchObject('Transferencia');
        if ($transf !== false)
        {
            $transf->setData($transf->getData());

            return $transf;
        }
        return null;
    }

    private function buscarTudo(string $coluna, string $ordem) : ?array
    {
        $query = "SELECT * FROM TRANSFERENCIA ORDER BY $coluna $ordem";

        $stmt = $this->bd->query($query);
        
        $transferencias = [];

        while ($transf = $stmt->fetchObject('Transferencia'))
        {
            $transf->setData($transf->getData());
            $transferencias[] = $transf;
        }

        return count($transferencias) > 0 ? $transferencias : null;
    }
}
?>