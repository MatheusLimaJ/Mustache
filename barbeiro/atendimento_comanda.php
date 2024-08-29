<?php 
if(!isset($_SESSION)) {
    include '../admin/acesso_com.php';
}
include '../conn/connect.php';

// Inicializa o valor do agendamento
$agendamento_form = 0;

// Verifica se existe um parâmetro 'id' na URL
if(isset($_GET['id'])) {
    $agendamento_form = intval($_GET['id']);
    echo 'ID Agendamento: ' . $agendamento_form;
    
    // Busca os dados do agendamento correspondente
    $listaAgenda = $conn->query("SELECT * FROM agendamentos WHERE id = $agendamento_form");
    $rowAgenda = $listaAgenda->fetch_assoc();
    print_r($rowAgenda);
}

// Busca na tabela de profissionais o ID do profissional logado
$listaProfissional = $conn->query("SELECT id FROM profissionais WHERE usuario_id = " . intval($_SESSION['usuario_id']));
$rowProfissional = $listaProfissional->fetch_assoc();
$profissional_id = $rowProfissional['id'];

// Verifica se o formulário foi enviado via POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $agendamento_id = $agendamento_form;
    $descricao = $conn->real_escape_string($_POST['descAtendimento']);
    $InsereAtendimento = "INSERT INTO atendimentos (agendamento_id, profissional_id, descricao) VALUES($agendamento_id, $profissional_id, '$descricao')";

    if($conn->query($InsereAtendimento)) 
    {
        $atendimento_id = $conn->insert_id;
        $listaAtendimento = $conn ->query("select * from atendimentos where id = $atendimento_id");
        $rowAtendimento = $listaAtendimento -> fetch_assoc();
        if($rowAtendimento['descricao'] == "agendado")
        {
            $cliente_id = $rowAgenda['cliente_id'];
            $insereComanda = "INSERT into comandas(atendimento_id, cliente_id, status, desconto) values($atendimento_id, $cliente_id, 'A', '0')";  
            $resultadoComanda = $conn -> query($insereComanda);
            if($resultadoComanda)
            {
                $comanda_id = $conn -> insert_id;
                $servico_id = $rowAgenda['servico_id'];
                $listaServico = $conn ->query("select * from servicos where id = $servico_id");
                $rowServico = $listaServico -> fetch_assoc();
                $valor = $rowServico['valor_unit'];

                $query = "INSERT into comandaservico(servico_id, comanda_id, preco, desconto) values($servico_id, $comanda_id, $valor, '0.00')";
                if($conn->query($query))
                {
                    header('Location: agendamentos_lista.php');
                    exit;
                }
            }
            else
            {
                echo "Comanda não inserirda: " . $conn ->error;
            }
        }
        else
        {
            $cliente_id = $rowAgenda['cliente_id'];
            $insereComanda = "INSERT into comandas(atendimento_id, cliente_id, status, desconto) values($atendimento_id, $cliente_id, 'A', '0')";  
            $resultadoComanda = $conn -> query($insereComanda);
            if ($resultadoComanda)
            {
                $comanda_insert = $conn -> insert_id;
                header("Location: servico_comanda.php?id=$comanda_insert");
            }
        }
    } 
    else 
    {
        echo "Erro: " . $conn->error;
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
    <title>Atendimento</title>
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
                    Concluir Atendimento!
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-dark" role="alert">
                        <form action="atendimento_comanda.php?id=<?php echo $agendamento_form; ?>" method="post" name="form_insere" enctype="multipart/form-data" id="form_insere">
                            <!-- Capturar ID do agendamento -->
                            <input type="hidden" name="agendamento_id" id="agendamento_id" value="<?php echo $rowAgenda['id']; ?>">

                            <div class="form-group">
                                <label for="descAtendimento" class="control-label">Tipo de Atendimento:</label>
                                <select class="form-control" id="descAtendimento" name="descAtendimento">
                                    <option value="" disabled selected>Selecione uma opção</option>
                                    <option value="agendado">Atendimento apenas dos serviços agendados</option>
                                    <option value="acrescimo">Acréscimo de serviço</option>
                                </select>
                            </div>

                            <br>
                            <!-- Botão de envio -->
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
                dots: true,
                infinity: true,
                slidesToShow: 3,
                slideToScroll: 3
            });
        });
    </script>
</body>
</html>
