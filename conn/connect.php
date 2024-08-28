<?php 
$host = "localhost";
$database = "mustachedb02";
$user = "root";
$password = "";
$charset = "utf8";
$port = "3306";

try
{
    $conn = new mysqli($host, $user, $password, $database, $port);
    mysqli_set_charset($conn, $charset);
}
catch(\Throwable $th)
{
    die("Atenção rolou um ERRO: " . $th);
}

?>