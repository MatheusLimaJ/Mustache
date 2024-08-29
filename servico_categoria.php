<?php
include 'conn/connect.php';
$idTipo = $_GET['id_tipo'];
 
$listaPorTipo = $conn->query("select * from vw_servicos where categoria_id = $idTipo");
$rowPorTipo =$listaPorTipo->fetch_assoc();
$categoria = $rowPorTipo['categoria_descricao'];
$numLinhas = $listaPorTipo->num_rows;
?>
 
 
 
                <!DOCTYPE html>
                <html lang="pt-BR">
                <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" href="css/bootstrap.min.css">
                        <link rel="stylesheet" href="css/estilo.css" class="css">
                    <title>Mustache </title>
                </head>
 
                <body class="fundofixo">
                <?php include 'menu_publico.php'; ?>    
                <a name="home">&nbsp;</a>
                <main class="container">
       
 
<!-- Mostrar se a consulta retornar vazia -->
 
<?php
if ($numLinhas == 0) { ?>
 
<h2 class="breadcrumb alert-danger">
<a href="javascript:window.history.go(-1)" class="btn btn-danger">
    <span class="glyphicon glyphicon-chevron-left"></span>
</a>    
Não há serviços cadastrados! tipo <?php echo $categoria;?>
</h2>
 
 
<?php }?>
<?php
if ($numLinhas > 0) { ?>
<!-- Mostrar se a consulta retornou produtos -->
 
<h2 class="breadcrumb alert-danger">
<a href="javascript:window.history.go(-1)" class="btn btn-danger">
    <span class="glyphicon glyphicon-chevron-left"></span>
</a>    
        <strong><?php echo $categoria;?>
</strong> </h2>
 
</h2>
<div class="row">
    <?php do{ ?>
  <div class="col-sm-6 col-md-4">
    <!-- Mostre enquanto -->
    <div class="thumbnail">
        <a href="produto_detalhes.php?id=<?php echo $rowPorTipo['id'] ?>">
          <img src="images/<?php echo $rowPorTipo['imagem'] ?>" alt="" class="img-responsive rounded">
        </a>  
        <div class="caption text-right">
          <h3 class="text-dark">
            <strong><?php echo $rowPorTipo['nome']?></strong>
          </h3>
          <p class="text-dark">
            <strong><?php echo mb_strimwidth($rowPorTipo['detalhe'],0,45,'...')?></strong>
          </p>
 
<p class="text-primary text-left">
<?php echo $rowPorTipo['categoria_descricao']; ?>
</p>
 
<p>
<button class="btn btn-default disabled" role="button" style="cursor:default;">
 <?php  echo "R$ " .number_format($rowPorTipo['valor_unit'],2,',','.')?>
 
</button>
 
<a href="produto_detalhes.php?id="<?php echo $rowPorTipo['id']; ?>>
<span class="hidden-xs">Saiba mais...</span>
<span class="hidden-xs glyphicon glyphicon-eye-open" aria-hidden="true"></span>
</a>
 
</p>
 
 
      </div>
</div>
</div>
 
 
<?php }while($rowPorTipo = $listaPorTipo->fetch_assoc()); ?>
</div>
 
 
<?php } ?>
 
</main>
</body>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).on('ready', function(){
        $(".regular").slick({
        dots:true,
        infinity:true,
        slidesToShow:3,
        slideToScroll:3
        });
       
    });
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick.min.js"></script>
</html>