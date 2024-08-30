<?php

//Chama conexão
include 'acesso_com.php';
include '../conn/connect.php';


$listaServico = $conn -> query("select * from vw_servicos");
$row = $listaServico -> fetch_assoc();


$listaProfissional = $conn -> query("select * from profissionais where disponibilidade = 'S' and ativo = 1");
$rowPro = $listaProfissional -> fetch_assoc();

$cliente_id = $_SESSION['cliente_id'];



if ($_POST)
{
    $cliente_id = $_SESSION['cliente_id'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $servico = $_POST['servico_id'];
    $profissional = $_POST['profissional_id'];

    // criar a soma da hora de inicio com a hora do serviço
    $servicoHora = $conn -> query("select * from servicos where id = " . $servico);
    $rowHora = $servicoHora -> fetch_assoc();

    $hora_termino = $rowHora['duracao_estimada'];

    // Converta as horas para timestamps
    $timestamp1 = strtotime($horario);
    $timestamp2 = strtotime($hora_termino);

    // Some os timestamps
    $soma = $timestamp1 + ($timestamp2 - strtotime('00:00'));

    // Converta o timestamp resultante de volta para o formato de hora
    $hora_termino = date('H:i:s', $soma);



    $insert = "INSERT INTO agendamentos
    (cliente_id, profissional_id, servico_id, status, data, hora_inicio, hora_termino, 
    data_criacao) values('$cliente_id', '$profissional', '$servico', 'CON', '$data', '$horario', '$horario', NOW())";
    if($conn->query($insert))
    {
        header('location: confirmacao.php');
        exit;
    }
    else
    {
        echo "Erro ao inseri pedido: " . $conn->error;
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
                    <form action="agendar.php" method="post"
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
                            <?php
                            // Função para gerar as opções de horários
                                function gerarHorarios()
                                {                 
                                    $opcoes = [];                
                                    $inicio = new DateTime('00:00');                 
                                    $intervalo = new DateInterval('PT30M');                 
                                    $fim = new DateTime('23:30');                                 
                                    while ($inicio <= $fim) {                     
                                    $opcoes[] = $inicio->format('H:i');                     
                                    $inicio->add($intervalo);                 
                                    }                                
                                    return $opcoes;             
                                } 
                                // Gerar e exibir as opções
                                $horarios = gerarHorarios(); 
                                foreach ($horarios as $horario) 
                                { 
                                    echo "<option value=\"$horario\">$horario</option>"; 
                                } 
                            ?>
                        </select>
                        <br>
                       <br>
 
                        <label for="servico">Serviço:</label>    
                        <div class="form-group">
                        <select id="servico_id" name="servico_id" class="form-control" required>
                            <?php do{?>
                                <option value="<?php echo $row['id'] ?>"> <?php echo $row['nome']?></option>
                            <?php } while($row = $listaServico -> fetch_assoc())?>
                        </select>
                        </div>  
                        <br>
               
                        <label for="profissional">Profissional:</label>    
                        <div class="form-group">
                        <select id="profissional_id" name="profissional_id" class="form-control" required>
                            <?php do{?>
                                <option value="<?php echo $rowPro['id'] ?>"> <?php echo $rowPro['nome']?></option>
                            <?php } while($rowPro = $listaProfissional -> fetch_assoc())?>
                        </select>
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
 