<?php 
    include 'conn/connect.php';

    $id = $_GET['id'];
    $listaDestaque = $conn -> query("select * from vw_servicos where id = " . $id);
    $rowDestaque = $listaDestaque -> fetch_assoc();
    $numDestaque = $listaDestaque ->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Serviço</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body class="fundofixo">
    <?php include 'menu_publico.php'?>

    <div class="container">
        <h2 class="breadcrumb alert-default">
            <a href="index.php">
                <button class="btn btn-default">
                    <span class="glyphicon glyphicon-chevron-left">

                    </span>
                </button>
                <span style="color: black;"> Detalhes do Produto </span>
            </a>
        </h2>
        <div class="row">
            <?php do { ?>
                <div class="col-sm-12 col-md-12">
                    <div class="thumbnail">
                        <a href="">
                            <img src="images/<?php echo $rowDestaque['imagem']?>" 
                            alt="<?php echo $rowDestaque['detalhe']?>"
                            class="img-responsive img-rondend"
                            style="height:20em; border-radius: 10px; box-shadow: 5px 5px grey">
                        </a>
                        <div class="caption text-center">
                            <h3 class="text-white">
                                <strong> <?php echo $rowDestaque['nome']?> </strong>
                            </h3>
                            <p class="text-primary">
                            <strong> <?php echo $rowDestaque['categoria_descricao']?> </strong>
                            </p>
                            <p>
                            <?php echo $rowDestaque['detalhe']?>
                            </p>
                            <p>
                                <a href="cliente/agendar.php?id=<?php echo $row['id'];?>">
                                    <button id="atencao" type="button" class="btn btn-default btn-lg"> Agendar
                            
                                    </button>
                                </a>

                            </p>
                        </div>
                    </div>
                </div>








            <?php } while($rowDestaque = $listaDestaque -> fetch_assoc())?>
        </div>
    </div>
    









</body>
</html>