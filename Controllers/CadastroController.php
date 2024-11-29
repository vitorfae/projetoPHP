<?php 
require_once 'Repositories/LoginRepository.php';
require_once 'Utils/utils.php';

$loginRepository = new LoginRepository($pdo);

if (tem_post())
{
    $login = new Login();

    if (array_key_exists('usuario', $_POST))
    {
        $login->setUsuario($_POST['usuario']);
    }
    if (array_key_exists('senha', $_POST))
    {
        $login->setSenha($_POST['senha']);
    }

    $loginRepository->salvar($login);
    redirecionar('Login');
}

require __DIR__ . '/../Views/Login/cadastro.php';
?>