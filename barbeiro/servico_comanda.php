<?php 

if(!isset($_SESSION)) {
    include '../admin/acesso_com.php';
}
include '../conn/connect.php';

$listaServico = $conn->query("SELECT * FROM servicos");
$rowServico = $listaServico->fetch_assoc();

if(isset($_GET['id'])) {
    $comanda_id = intval($_GET['id']);
} else {
    die("ID da comanda não fornecido.");
}


if($_POST)
{
    $servico_id = $_POST['servico_id'];
    echo $servico_id;
    echo $agendamento_id;

    $query = "INSERT INTO comandaservico (servico_id, comanda_id, preco, desconto) VALUES ($servico_id, $comanda_id, '0.00', '0.00')";

    if($query)
    {
        header('Location: agendamentos_lista.php');
        exit;
    }
            
            else
            {
                echo "Comanda não inserirda: " . $conn ->error;
            }

}



?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png" type="icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css" class="css">
    <title>Comanda</title>
</head>
 
<body class="fundofixo">
    <!-- Área de menu -->
    <?php include '../menu_publico.php'; ?>
    <a name="home">&nbsp;</a>
 
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6 col-md-8">
                <h2 class="breadcrumb .bg-dark">
                    <a href="cadReserva.php">
                        <button class="btn btn-default">
                            <span class="glyphicon glyphicon-th-list"></span>
                        </button>
                    </a>
                Acréscimo na Comanda:
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-dark" role="alert">
                        <form action="servico_comanda.php" method="post" name="form_insere" enctype="multipart/form-data" id="form_insere">
                            <!-- Capturar ID do agendamento -->
                            <input type="hidden" name="coamanda_id" id="coamanda_id" value="<?php echo $comanda_id; ?>">

                            <div class="form-group">
                                <label for="descAtendimento" class="control-label">Serviço acrescentado:</label>
                                <select name="servico_id" id="servico_id" class="form-control" required>
                                <?php do {?>

                                    <option value="<?php echo $rowServico['id']; ?>">
                                       <!-- buscar tipo -->
                                       <?php echo $rowServico['nome']; ?>
                                       
                                    </option>
                                <?php }while($rowServico = $listaServico -> fetch_assoc()) ?>
                            </select>
                            </div>

                            <br>
                            <!-- Botão de envio -->
                            <input type="submit" name="enviar" id="env                                                                                                                              iar" class="btn btn-primary btn-block" value="Concluir atendimento">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on('ready', function(){
            $(".regular").slick({
                dots: true,
                infinity: true,
                slidesToShow: 3,
                slideToScroll: 3
            });
        });
    </script>
</body>
</html>
