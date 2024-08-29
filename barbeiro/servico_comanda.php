<?php 
if (!isset($_SESSION)) {
    include '../admin/acesso_com.php';
}
include '../conn/connect.php';

// Verifica se o ID da comanda foi passado via GET
if (isset($_GET['id'])) {
    $comanda_id = $_GET['id'];
} else {
    die("ID da comanda não fornecido.");
}

$listaServico = $conn->query("SELECT * FROM servicos");
$rowServico = $listaServico->fetch_assoc();


// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['servico_id'])) {
        $servico_id = $_POST['servico_id'];
        
        // Realiza o INSERT na tabela comandaservico
        $query = $conn->query("INSERT INTO comandaservico(servico_id, comanda_id, preco, desconto) VALUES ($servico_id, $comanda_id, '0.00', '0.00')");
        
        if ($query) {
            header('Location: agendamentos_lista.php');
            exit;
        } else {
            echo "Erro ao inserir na tabela comandaservico: " . $conn->error;
        }
    } else {
        echo "ID do serviço não foi fornecido.";
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
                        <form action="servico_comanda.php?id=<?php echo $comanda_id; ?>" method="post" name="form_insere" enctype="multipart/form-data" id="form_insere">
                            <!-- Capturar ID da comanda -->
                            <input type="hidden" name="comanda_id" id="comanda_id" value="<?php echo $comanda_id; ?>">

                            <div class="form-group">
                                <label for="servico_id" class="control-label">Serviço acrescentado:</label>
                                <select name="servico_id" id="servico_id" class="form-control" required>
                                    <?php 
                                    do {
                                        echo '<option value="'.$rowServico['id'].'">'.$rowServico['nome'].'</option>';
                                    } while ($rowServico = $listaServico->fetch_assoc()); 
                                    ?>
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
</body>
</html>
