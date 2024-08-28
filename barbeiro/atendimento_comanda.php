<?php 
if(!isset($_SESSION))
{
   include '../admin/acesso_com.php';
}
include '../conn/connect.php';



if($_GET)
{
    $agendamento_id = $_GET['id'];
    echo $agendamento_id;
}



// busca na tabela de profissionais o id do profissional que está logado
$listaProfissional = $conn -> query("select id from profissionais where usuario_id = " . $_SESSION['usuario_id']);
$profissional_id = $listaProfissional -> fetch_assoc();
print_r($profissional_id);







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
<title>Fazer reserva </title>
</head>
 
<body class="fundofixo">
    <!-- area de menu -->
    <?php include '../menu_publico.php'; ?>    
    <a name="home">&nbsp;</a>
 
    <main class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-6  col-md-8">
            <h2 class="breadcrumb .bg-dark">
                <a href="cadReserva.php">
                    <button class="btn btn-default">
                        <span class="glyphicon glyphicon-th-list"></span>
                    </button>
                </a>
                Concluir Atendimento!
            </h2>
            <div class="thumbnail">
                <div class="alert alert-dark " role="alert">
                    <form action="agendar.php" method="post"
                    name="form_insere" enctype="multipart/form-data"
                    id="form_insere">
 
                        <!-- Capturar ID da Reserva -->
                        <input type="hidden" name="id" id="id" class="form-control" placeholder="" maxlength="100" required>
 
 
 
                        <label for="motivo">Descrição do Atendimento:</label>    
                        <div class="input-group">
                           <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                           </span>
                           <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Digite a descricao do atendimento" maxlength="200" required>
                        </div>
                            <br>
                        <!-- Botão de envio usuário -->
                        <input type="submit" name="enviar" id="enviar" class="btn btn-primary btn-block" value="Concluir atendimento">
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
        dots:true,
        infinity:true,
        slidesToShow:3,
        slideToScroll:3
        });
    });
 