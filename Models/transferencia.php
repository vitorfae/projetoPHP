<?php 
require_once 'Utils/utils.php';

class Transferencia
{
    private int $id = 0;
    private int $ativo_id = 0;
    private int $filial_origem_id = 0;
    private int $setor_origem_id = 0;
    private int $filial_destino_id = 0;
    private int $setor_destino_id = 0;
    private $data_transferencia = null;

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setIdAtivo(int $id) : void
    {
        $this->ativo_id = $id;
    }

    public function getIdAtivo() : int
    {
        return $this->ativo_id;
    }

    public function setIdFilialOrigem(int $id) : void
    {
        $this->filial_origem_id = $id;
    }

    public function getIdFilialOrigem() : int
    {
        return $this->filial_origem_id;
    }

    public function setIdFilialDestino(int $id) : void
    {
        $this->filial_destino_id = $id;
    }

    public function getIdFilialDestino() : int
    {
        return $this->filial_destino_id;
    }

    public function setIdSetorOrigem(int $id) : void
    {
        $this->setor_origem_id = $id;
    }

    public function getIdSetorOrigem() : int
    {
        return $this->setor_origem_id;
    }

    public function setIdSetorDestino(int $id) : void
    {
        $this->setor_destino_id = $id;
    }

    public function getIdSetorDestino() : int
    {
        return $this->setor_destino_id;
    }

    public function setData(DateTime|string $data) : void
    {
        $this->data_transferencia = convertToDateTime($data);
    }

    public function getData() : ?DateTime
    {
        if (is_object($this->data_transferencia))
        {
            return $this->data_transferencia;
        }

        return new DateTime($this->data_transferencia);
    }
}
?>