<?php
session_start();
if(!isset($_SESSION))
{
   include "acesso_com.php";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Área Administrativa - Mustache</title>
</head>
<body >

    <div class="container">
        <h1>OLá ADMINISTRADOR</h1>
    </div>
</body>
</html>
