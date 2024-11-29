<?php
class Filial
{
    private int $id = 0;
    private string $nome_filial = '';
    private string $cnpj = '';
    private string $estado = '';
    private string $cidade = '';
    private string $bairro = '';
    private string $rua = '';
    private int $numero = 0;

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setCnpj(string $cnpj) : void
    {
        $this->cnpj = $cnpj;
    }

    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    public function setNome(string $nome) : void
    {
        $this->nome_filial = $nome;
    }

    public function getNome(): string
    {
        return $this->nome_filial;
    }

    public function setEstado(string $estado) : void
    {
        $this->estado = $estado;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setCidade(string $cidade) : void
    {
        $this->cidade = $cidade;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function setBairro(string $bairro) : void
    {
        $this->bairro = $bairro;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function setRua(string $rua) : void
    {
        $this->rua = $rua;
    }

    public function getRua(): string
    {
        return $this->rua;
    }

    public function setNumero(int $numero) : void
    {
        $this->numero = $numero;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }
}
