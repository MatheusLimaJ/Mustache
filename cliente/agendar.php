<?php
//Chama conexão
include '../conn/connect.php';

$listaServico = $conn -> query("select * from vw_servicos");
$row = $listaServico -> fetch_assoc();

// $linhasServicos = $linhasServicos -> num_rows;

$listaProfissional = $conn -> query("select * from usuarios where nivel_id = 1");
$rowPro = $listaProfissional -> fetch_assoc();


 
//inicia verificação do form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // randi
   
    //dados dos formularios

    // fecha conexão
    $stmt->close();
    $conn->close();
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
                Realizar agendamento!
            </h2>
            <div class="thumbnail">
                <div class="alert alert-dark " role="alert">
                    <form action="cadReserva.php" method="post"
                    name="form_insere" enctype="multipart/form-data"
                    id="form_insere">
 
                        <!-- Capturar ID da Reserva -->
                        <input type="hidden" name="id" id="id" class="form-control" placeholder="" maxlength="100" required>
 
 
 
                        <label for="data">Data: </label>    
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                            </span>
                            <input type="date" name="data" id="data" class="form-control" placeholder="Digite o o dia" maxlength="100" required>
                        </div>  
                        <br>
                        <label for="horario">Escolha a horario : </label>
                        <select id="horario" name="horario" required>
                            <option value="00:00">00:00</option>
                            <option value="00:30">00:30</option>
                            <option value="01:00">01:00</option>
                            <option value="01:30">01:30</option>
                            <option value="02:00">02:00</option>
                            <option value="02:30">02:30</option>
                            <option value="03:00">03:00</option>
                            <option value="03:30">03:30</option>
                            <option value="04:00">04:00</option>
                            <option value="04:30">04:30</option>
                            <option value="05:00">05:00</option>
                            <option value="05:30">05:30</option>
                            <option value="06:00">06:00</option>
                            <option value="06:30">06:30</option>
                            <option value="07:00">07:00</option>
                            <option value="07:30">07:30</option>
                            <option value="08:00">08:00</option>
                            <option value="08:30">08:30</option>
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                            <option value="18:00">18:00</option>
                            <option value="18:30">18:30</option>
                            <option value="19:00">19:00</option>
                            <option value="19:30">19:30</option>
                            <option value="20:00">20:00</option>
                            <option value="20:30">20:30</option>
                            <option value="21:00">21:00</option>
                            <option value="21:30">21:30</option>
                            <option value="22:00">22:00</option>
                            <option value="22:30">22:30</option>
                            <option value="23:00">23:00</option>
                            <option value="23:30">23:30</option>
                        </select>
                        <br>
                       <br>
 
                        <label for="servico">Serviço:</label>    
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-glass" aria-hidden="true"></span>
                            </span>
                            <input type="number" name="servico" id="servico" class="form-control" placeholder="" maxlength="1" required>
                        </div>  
                        <br>
               
                        <label for="profissional">Profissional:</label>    
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-glass" aria-hidden="true"></span>
                            </span>
                            <input type="number" name="profissional" id="profissional" class="form-control" placeholder="Escolha o seu profissional" maxlength="1" required>
                        </div>  
                        <br>
 
 
                        <!-- Gerar numero da reserva -->
                        <input type="hidden" name="codigoReserv" id="codigoReserv" class="form-control" placeholder="" maxlength="100" required>
                            <br>
                        <!-- Botão de envio usuário -->
                        <input type="submit" name="enviar" id="enviar" class="btn btn-dark btn-block" value="Agendar">
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
 