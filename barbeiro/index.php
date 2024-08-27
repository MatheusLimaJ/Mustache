<?php
if(!isset($_SESSION))
{
   include '../admin/acesso_com.php';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Área Administrativa - </title>
</head>
<body >
    <?php include 'menu_barbeiro.php'; ?>
    <?php include 'barbeiro_options.php'; ?>
    <div class="container">
  
    </div>
</body>
</html>



