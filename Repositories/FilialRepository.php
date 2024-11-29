<?php 
require_once __DIR__ . '/../Models/filial.php';

class FilialRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    public function salvar(Filial $filial) : void
    {
        $cnpj = $filial->getCnpj();
        $nome = $filial->getNome();
        $estado = $filial->getEstado();
        $cidade = $filial->getCidade();
        $bairro = $filial->getBairro();
        $rua = $filial->getRua();
        $numero = $filial->getNumero();

        $query = "
            INSERT INTO FILIAL (NOME_FILIAL, CNPJ, ESTADO, CIDADE, BAIRRO, RUA, NUMERO)
            VALUES
            (
                :nome,
                :cnpj,
                :estado,
                :cidade,
                :bairro,
                :rua,
                :numero
            )
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':nome' => $nome,
            ':cnpj' => $cnpj,
            ':estado' => $estado,
            ':cidade' => $cidade,
            ':bairro' => $bairro,
            ':rua' => $rua,
            ':numero' => $numero
        ]);
    }

    public function atualizar(Filial $filial) : void
    {
        $id = $filial->getId();
        $cnpj = $filial->getCnpj();
        $nome = $filial->getNome();
        $estado = $filial->getEstado();
        $cidade = $filial->getCidade();
        $bairro = $filial->getBairro();
        $rua = $filial->getRua();
        $numero = $filial->getNumero();

        $query = "
            UPDATE FILIAL SET
                NOME_FILIAL = :nome,
                CNPJ = :cnpj,
                ESTADO = :estado,
                CIDADE = :cidade,
                BAIRRO = :bairro,
                RUA = :rua,
                NUMERO = :numero
            WHERE ID = :id
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':nome' => $nome,
            ':cnpj' => $cnpj,
            ':estado' => $estado,
            ':cidade' => $cidade,
            ':bairro' => $bairro,
            ':rua' => $rua,
            ':numero' => $numero,
            ':id' => $id
        ]);
    }

    public function remover(int $id) : bool
    {
        $query = "DELETE FROM FILIAL WHERE ID = :id";

        $stmt = $this->bd->prepare($query);
        
        return $stmt->execute([':id' => $id]);
    }

    public function buscar(int $id = 0, string $coluna = 'id', string $ordem = 'asc') : Filial|array|null
    {
        if ($id > 0)
        {
            return $this->buscarFilial($id);
        }
        else
        {
            return $this->buscarFiliais($coluna, $ordem);
        }
    }

    private function buscarFilial(int $id) : ?Filial
    {
        $query = "SELECT * FROM FILIAL WHERE ID = :id";
        
        $stmt = $this->bd->prepare($query);
        $stmt->execute([':id' => $id]);

        $filial = $stmt->fetchObject('Filial');

        return $filial === false ? null : $filial;
    }

    private function buscarFiliais(string $coluna, string $ordem) : ?array
    {
        $query = "SELECT * FROM FILIAL ORDER BY $coluna $ordem";
        $stmt = $this->bd->query($query);

        $filiais = [];

        while ($filial = $stmt->fetchObject('Filial'))
        {
            $filiais[] = $filial;
        }

        return count($filiais) > 0 ? $filiais : null;
    }
}
?>