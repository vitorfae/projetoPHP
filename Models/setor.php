<?php 
class Setor
{
    private int $id = 0;
    private string $descricao = '';

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setDescricao(string $desc) : void
    {
        $this->descricao = $desc;
    }

    public function getDescricao() : string
    {
        return $this->descricao;
    }
}
?>