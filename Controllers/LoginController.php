<?php 
require_once 'Repositories/LoginRepository.php';
require_once 'Utils/utils.php';

$loginRepository = new LoginRepository($pdo);
$tem_erro = false;

if (tem_post())
{
    $usuario = $loginRepository->buscarPorUsuario($_POST['usuario']);

    if ($usuario !== null && password_verify($_POST['senha'], $usuario->getSenha()))
    {
        if (!isset($_SESSION))
        {
            session_start();
        }

        $_SESSION['id'] = $usuario->getId();

        redirecionar('Ativo');
    }
    else
    {
        $tem_erro = true;
    }
}

if (isset($_GET['logout']))
{
    if (!isset($_SESSION))
    {
        session_start();
    }

    session_destroy();
    redirecionar('Login');
}
require __DIR__ . '/../Views/Login/login.php';
?>