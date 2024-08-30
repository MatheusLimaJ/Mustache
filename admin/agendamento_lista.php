<?php 
if(!isset($_SESSION))
{
    include '../admin/acesso_com.php';
}
include '../conn/connect.php';

$lista = $conn->query('SELECT * FROM vw_agendamentos WHERE status = "CON"');
$rows = $lista->num_rows;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - Lista</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>

    <?php include 'menu_admin.php'?>
    <main class="container">
        <h2 class="breadcrumb alert-dark">Agendamentos</h2>
        
        <?php if ($rows > 0) { ?>
            <table class="table table-hover table-condensed tb-opacidade bg-dark">
                <thead>
                    <th class="hidden">ID</th>
                    <th></th>
                    <th>CLIENTE</th>
                    <th>SERVIÇO</th>
                    <th>DATA</th>
                    <th>INICIO</th>
                    <th>TERMINO</th>
                    <th>
                        <a href="tipos_insere.php" target="_self" class="btn btn-block btn-primary btn-xs" role="button">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            <span class="hidden-xs">ADICIONAR</span>
                        </a>
                    </th>
                </thead>
                <tbody>
                    <?php while($rowAgenda = $lista->fetch_assoc()) { ?>
                        <tr>
                            <td class="hidden">
                                <input type="hidden" value="<?php echo $rowAgenda['id']; ?>">
                            </td>
                            <td></td>
                            <td><?php echo $rowAgenda['cliente_nome']; ?></td>
                            <td><?php echo $rowAgenda['servico_nome']; ?></td>
                            <td><?php echo $rowAgenda['data']; ?></td>
                            <td><?php echo $rowAgenda['hora_inicio']; ?></td>
                            <td><?php echo $rowAgenda['hora_termino']; ?></td>
                            <td>
                                <a href="atendimento_comanda.php?id=<?php echo $rowAgenda['id']; ?>" role="button" class="btn btn-success btn-block btn-xs">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span class="hidden-xs">ATENDER</span>
                                </a>
                                <button data-nome="<?php echo $rowAgenda['motivo']; ?>" data-id="<?php echo $rowAgenda['id']; ?>" class="delete btn btn-xs btn-block btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    <span class="hidden-xs"> CANCELAR</span>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                Ainda não existem agendamentos
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
                    Deseja mesmo excluir o tipo?
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
        var nome = $(this).data('nome'); //busca o nome com a descrição (data-nome)
        var id = $(this).data('id'); // busca o id (data-id)
        $('span.nome').text(nome); // insere o nome do item na confirmação
        $('a.delete-yes').attr('href', 'agendamento_cancela.php?id=' + id); //chama o arquivo php para excluir o produto
        $('#modalEdit').modal('show'); // chamar o modal
    });
</script>
 
</html>
