<?php 
class Login
{
    private int $id = 0;
    private string $usuario;
    private string $senha;

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setUsuario(string $usuario) : void
    {
        $this->usuario = $usuario;
    }

    public function getUsuario() : string
    {
        return $this->usuario;
    }

    public function setSenha(string $senha) : void
    {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function getSenha() : string
    {
        return $this->senha;
    }
}
?>