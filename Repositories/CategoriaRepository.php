<?php 
require_once __DIR__ . '/../Models/categoria.php';

class CategoriaRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    public function salvar(Categoria $categoria) : void
    {
        $descricao = $categoria->getDescricao();

        $query = "INSERT INTO CATEGORIA (DESCRICAO) VALUES (:descricao)";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([':descricao' => $descricao]);
    }

    public function atualizar(Categoria $categoria) : void
    {
        $id = $categoria->getId();
        $descricao = $categoria->getDescricao();

        $query = "
            UPDATE CATEGORIA SET
                DESCRICAO = :descricao
            WHERE ID = :id;
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([':descricao' => $descricao, ':id' => $id]);
    }

    public function remover(int $id) : bool
    {
        $query = "DELETE FROM CATEGORIA WHERE ID = :id";
        
        $stmt = $this->bd->prepare($query);
        
        return $stmt->execute([':id' => $id]);
    }

    public function buscar(int $id = 0, string $coluna = 'id', string $ordem = 'asc') : Categoria|array|null
    {
        if ($id > 0)
        {
            return $this->buscarCategoria($id);
        }
        else
        {
            return $this->buscarCategorias($coluna, $ordem);
        }
    }

    private function buscarCategoria(int $id) : ?Categoria
    {
        $query = "SELECT * FROM CATEGORIA WHERE ID = :id";
        
        $stmt = $this->bd->prepare($query);
        $stmt->execute([':id' => $id]);
        
        $categoria = $stmt->fetchObject('Categoria');

        return $categoria === false ? null : $categoria;
    }

    private function buscarCategorias(string $coluna, string $ordem) : ?array
    {
        $query = "SELECT * FROM CATEGORIA ORDER BY $coluna $ordem";
        $stmt = $this->bd->query($query);

        $categorias = [];

        while ($categoria = $stmt->fetchObject('Categoria'))
        {
            $categorias[] = $categoria;
        }
        
        return count($categorias) > 0 ? $categorias : null;
    }
}
?>