<?php 
// define nome para a sessão
session_name('login');

// starta a sessão
if(!isset($_SESSION))
{
    session_start();
}
//Verifica se o usuário está logado
if(!isset($_SESSION['login_usuario']))
{
    header('location: ../admin/login.php');
    exit;
}

$nome_da_sessao = session_name();
if(!isset($_SESSION['nome_da_sessao']) or ($_SESSION['nome_da_sessao']))
{
    session_destroy();
    header('location:login.php');
    exit;
}


?>