<?php 
require_once 'Models/login.php';

class LoginRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    public function salvar(Login $login) : void
    {
        $usuario = $login->getUsuario();
        $senha = $login->getSenha();

        $query = '
            INSERT INTO LOGIN (usuario, senha)
            VALUES (:usuario, :senha)
        ';

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':usuario' => $usuario,
            ':senha' => $senha
        ]);
    }

    public function atualizar(Login $login) : void
    {
        $id = $login->getId();
        $usuario = $login->getUsuario();
        $senha = $login->getSenha();

        $query = '
            UPDATE LOGIN SET
                usuario = :usuario,
                senha = :senha
            WHERE id = :id
        ';

        $stmt = $this->bd->prepare($query);
        $stmt->execute([
            ':id' => $id,
            ':usuario' => $usuario,
            ':senha' => $senha
        ]);
    }

    public function remover(int $id) : bool
    {
        $query = 'DELETE FROM LOGIN WHERE id = :id';

        $stmt = $this->bd->prepare($query);

        return $stmt->execute([':id' => $id]);
    }

    public function buscar(int $id = 0) : Login|Array|null
    {
        if ($id > 0)
        {
            return $this->buscarLogin($id);
        }
        else
        {
            return $this->buscarTudo();
        }
    }

    public function buscarPorUsuario(string $usuario) : ?Login
    {
        $query = 'SELECT * FROM LOGIN WHERE usuario = :usuario';

        $stmt = $this->bd->prepare($query);
        $stmt->execute([':usuario' => $usuario]);

        $login = $stmt->fetchObject('Login');

        return $login === false ? null : $login;  
    }

    private function buscarLogin(int $id) : ?Login
    {
        $query = 'SELECT * FROM LOGIN WHERE id = :id';

        $stmt = $this->bd->prepare($query);
        $stmt->execute([':id' => $id]);

        $login = $stmt->fetchObject('Login');

        return $login === false ? null : $login;
    }

    private function buscarTudo() : ?array
    {
        $query = 'SELECT * FROM LOGIN';

        $stmt = $this->bd->query($query);

        $logins = [];

        while ($login = $stmt->fetchObject('Login'))
        {
            $logins[] = $login;
        }

        return count($logins) > 0 ? $logins : null;
    }
}
?>