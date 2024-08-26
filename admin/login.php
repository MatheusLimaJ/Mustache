<?php 

include '../conn/connect.php';

if($_POST)
{
    $login = $_POST['login'];
    $senha = md5($_POST['senha']); 
    $loginResult = $conn -> query("select * from usuarios where email = '$login' and senha = '$senha' ");
    $numRow = $loginResult -> num_rows;

    //se a sessão não existir
    if(!isset($_SESSION))
    {
        $sessaoAntiga = session_name();
        session_start();
        $session_name_new = session_name();
    }

    if($numRow > 0)
    {
        $_SESSION['usuario_id'] = $rowLogin['id'];
    }
}

?>