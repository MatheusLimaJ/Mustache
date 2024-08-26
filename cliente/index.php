<?php 
session_start();
 if(!isset($_SESSION)){
        include 'acesso_com.php';
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Área Cliente - Chuleta Quente</title>
</head>
<body >
  <?php include 'menu_cliente.php';?> 
</body>
</html>





<a href="../admin/logout.php">
    sair
</a>