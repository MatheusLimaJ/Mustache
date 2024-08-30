<?php 
if(!isset($_SESSION))
{
    include '../admin/acesso_com.php';
}
include '../conn/connect.php';

// Consulta a tabela comandas
$lista = $conn->query('SELECT * FROM comandas where status = "A"');
$rows = $lista->num_rows;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandas - Lista</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>

    <?php include 'menu_admin.php'?>
    <main class="container">
        <h2 class="breadcrumb alert-dark">Comandas</h2>
        
        <?php if ($rows > 0) { ?>
            <table class="table table-hover table-condensed tb-opacidade bg-dark">
                <thead>
                    <th class="hidden">ID</th>
                    <th>ATENDIMENTO</th>
                    <th>CLIENTE</th>
                    <th>STATUS</th>
                    <th>DESCONTO</th>
                    <th>
                        
                    </th>
                </thead>
                <tbody>
                    <?php while($rowComanda = $lista->fetch_assoc()) { ?>

                        <tr>
                            <td class="hidden">
                                <input type="hidden" value="<?php echo $rowComanda['id']; ?>">
                            </td>
                            <td><?php echo $rowComanda['atendimento_id']; ?></td>
                            <?php 
                                $listaCliente = $conn->query("SELECT * FROM clientes where id =" . $rowComanda['cliente_id']);
                                $rowCliente = $listaCliente -> fetch_assoc();
                            ?>
                            <td><?php echo $rowCliente['nome']; ?></td>
                            <td><?php echo $rowComanda['status']; ?></td>
                            <td><?php echo $rowComanda['desconto']; ?></td>
                            <td>
                                <a href="comanda_edita.php?id=<?php echo $rowComanda['id']; ?>" role="button" class="btn btn-success btn-block btn-xs">
                                    <span class="glyphicon glyphicon-usd"></span>
                                    <span class="hidden-xs">PAGAR </span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                Ainda não existem comandas
            </div>
        <?php } ?>
    </main>

    <!-- inicio do modal para excluir... -->
    <div class="modal fade" id="modalEdit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Vamos deletar?</h4>
                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    Deseja mesmo excluir a comanda?
                    <h4><span class="nome text-danger"></span></h4>
                </div>
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-danger delete-yes">Confirmar</a>
                    <button class="btn btn-success" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('.delete').on('click', function(){
        var id = $(this).data('id'); // busca o id (data-id)
        $('a.delete-yes').attr('href', 'comanda_cancela.php?id=' + id); //chama o arquivo php para excluir a comanda
        $('#modalEdit').modal('show'); // chamar o modal
    });
</script>
 
</html>
