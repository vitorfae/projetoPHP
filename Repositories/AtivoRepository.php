<?php 
require_once __DIR__ . '/../Models/ativo.php';

class AtivoRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    public function salvar(Ativo $ativo) : void
    {
        $setor_id = $ativo->getSetorId();
        $filial_id = $ativo->getFilialId();
        $categoria_id = $ativo->getCategoriaId();
        $descricao = $ativo->getDescricao();
        $data_cadastro = $ativo->getDataCadastro();
        $data_aquisicao = $ativo->getDataAquisicao();
        $vida_util = $ativo->getVidaUtil();
        $condicao = $ativo->getCondicao();
        $estado = $ativo->getEstadoAtivo();
        $valor = $ativo->getValor();

        if (is_object($data_cadastro))
        {
            $data_cadastro = $data_cadastro->format('Y-m-d H:i:s');   
        }

        if (is_object($data_aquisicao))
        {
            $data_aquisicao = $data_aquisicao->format('Y-m-d H:i:s');
        }

        $query = "
            INSERT INTO ATIVO (FILIAL_ID, SETOR_ID, CATEGORIA_ID, DESCRICAO, DATA_CADASTRO, DATA_AQUISICAO, VIDA_UTIL, CONDICAO, ESTADO_ATIVO, VALOR)
            VALUES 
            (:filial_id, :setor_id, :categoria_id, :descricao, :data_cadastro, :data_aquisicao, :vida_util, :condicao, :estado, :valor)
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':filial_id' => $filial_id,
            ':setor_id' => $setor_id,
            ':categoria_id' => $categoria_id,
            ':descricao' => $descricao,
            ':data_cadastro' => $data_cadastro,
            ':data_aquisicao' => $data_aquisicao,
            ':vida_util' => $vida_util,
            ':condicao' => $condicao,
            ':estado' => $estado,
            ':valor' => $valor 
        ]);
    }

    public function atualizar(Ativo $ativo) : void
    {
        $id = $ativo->getId();
        $setor_id = $ativo->getSetorId();
        $filial_id = $ativo->getFilialId();
        $categoria_id = $ativo->getCategoriaId();
        $descricao = $ativo->getDescricao();
        $data_cadastro = $ativo->getDataCadastro();
        $data_aquisicao = $ativo->getDataAquisicao();
        $vida_util = $ativo->getVidaUtil();
        $condicao = $ativo->getCondicao();
        $estado = $ativo->getEstadoAtivo();
        $valor = $ativo->getValor();

        if (is_object($data_cadastro))
        {
            $data_cadastro = $data_cadastro->format('Y-m-d H:i:s');   
        }

        if (is_object($data_aquisicao))
        {
            $data_aquisicao = $data_aquisicao->format('Y-m-d H:i:s');
        }

        $query = "
            UPDATE ATIVO SET
                FILIAL_ID = :filial_id,
                SETOR_ID = :setor_id,
                CATEGORIA_ID = :categoria_id,
                DESCRICAO = :descricao,
                DATA_CADASTRO = :data_cadastro,
                DATA_AQUISICAO = :data_aquisicao,
                VIDA_UTIL = :vida_util,
                CONDICAO = :condicao,
                ESTADO_ATIVO = :estado,
                VALOR = :valor
            WHERE ID = :id
        ";

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':filial_id' => $filial_id,
            ':setor_id' => $setor_id,
            ':categoria_id' => $categoria_id,
            ':descricao' => $descricao,
            ':data_cadastro' => $data_cadastro,
            ':data_aquisicao' => $data_aquisicao,
            ':vida_util' => $vida_util,
            ':condicao' => $condicao,
            ':estado' => $estado,
            ':valor' => $valor,
            ':id' => $id
        ]);
    }

    public function remover(int $id) : bool
    {
        $query = "DELETE FROM ATIVO WHERE ID = :id";
        $stmt = $this->bd->prepare($query);
        
        return $stmt->execute([':id' => $id]);
    }

    public function buscar(int $id = 0, string $coluna = 'id', string $ordem = 'asc') : Ativo|array|null
    {
        if ($id > 0)
        {
            return $this->buscarAtivo($id);
        }
        else
        {
            return $this->buscarAtivos($coluna, $ordem);
        }
    }

    private function buscarAtivo(int $id) : ?Ativo
    {
        $query = "SELECT * FROM ATIVO WHERE ID = :id";
        $stmt = $this->bd->prepare($query);

        $stmt->execute([':id' => $id]);

        $ativo = $stmt->fetchObject('Ativo');
        if ($ativo !== false) 
        {
            $ativo->setDataCadastro($ativo->getDataCadastro());
            $ativo->setDataAquisicao($ativo->getDataAquisicao());

            return $ativo;
        }

        return null;
    }

    private function buscarAtivos(string $coluna, string $ordem) : ?array
    {
        $query = "SELECT * FROM ATIVO ORDER BY $coluna $ordem";   
        
        $stmt = $this->bd->query($query);

        $ativos = [];

        while ($ativo = $stmt->fetchObject('Ativo'))
        {
            $ativo->setDataCadastro($ativo->getDataCadastro());
            $ativo->setDataAquisicao($ativo->getDataAquisicao());
            
            $ativos[] = $ativo;
        }

        return count($ativos) > 0 ? $ativos : null;
    }
}
?>