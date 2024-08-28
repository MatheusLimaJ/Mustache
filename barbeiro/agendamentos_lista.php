<?php 
if(!isset($_SESSION))
{
   include '../admin/acesso_com.php';
}
include '../conn/connect.php';

$lista = $conn -> query('select * from vw_agendamentos where status = "CON"');
$rowAgenda = $lista -> fetch_assoc();
$rows = $lista -> num_rows;


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

    <?php include 'menu_barbeiro.php'?>
    <main class="container">
        <h2 class="breadcrumb alert-dark">Seus Agendamentos</h2>
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
           
            <tbody> <!-- início corpo da tabela -->
                    <!-- início estrutura repetição -->
                <?php do{ ?>
                        <tr>
                            <td class="hidden">
                                <?php echo $rowAgenda['id']; ?>
                            </td>
                            <td></td>
                            <td>
                               <?php echo $rowAgenda['cliente_nome']?>
                                <span class="visible-xs"></span>
                                <spin class="hidden-xs"></spin>
                            </td>
                            <td>
                                <?php 
                                    echo $rowAgenda['servico_nome'];
                                ?>
                            </td>

                            <td>
                                <?php 
                                    echo $rowAgenda['data'];
                                ?>
                            </td>

                            <td>
                                <?php 
                                    echo $rowAgenda['hora_inicio'];
                                ?>
                            </td>
                           
                            <td>
                                <?php 
                                    echo $rowAgenda['hora_termino'];
                                ?>
                            </td>

                            <td>
                                <a 
                                    href="comanda.php?id= <?php echo $row['id'] ?>"
                                    role="button" 
                                    class="btn btn-success btn-block btn-xs">

                                    <span class="glyphicon glyphicon-ok"></span>
                                    <span class="hidden-xs">ATENDER</span>

                                </a>
                     
                                
                                <button
                                    data-nome="<?php echo $row['motivo']; ?>"
                                    data-id="<?php echo $row['id']; ?>"
                                    class="delete btn btn-xs btn-block btn-danger"
                                >
                                    <span class="glyphicon glyphicon-trash"></span>
                                    <span class="hidden-xs"> CANCELAR</span>
                                </button>
                                
                            </td>
                        </tr>
                <?php }while($row = $lista -> fetch_assoc()); ?>
                 
                 

            </tbody><!-- final corpo da tabela -->
        </table>
    </main>
    <!-- inicio do modal para excluir... -->
    <div class="modal fade" id="modalEdit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Vamos deletar?</h4>
                    <button class="close" data-dismiss="modal" type="button">
                        &times;
 
                    </button>
                </div>
                <div class="modal-body">
                    Deseja mesmo excluir o tipo?
                    <h4><span class="nome text-danger"></span></h4>
                </div>
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-danger delete-yes">
                        Confirmar
                    </a>
                    <button class="btn btn-success" data-dismiss="modal">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('.delete').on('click',function(){
        var nome = $(this).data('motivo'); //busca o nome com a descrição (data-nome)
        var id = $(this).data('id'); // busca o id (data-id)
        //console.log(id + ' - ' + nome); //exibe no console
        $('span.nome').text(nome); // insere o nome do item na confirmação
        $('a.delete-yes').attr('href','agendamento_cancela.php?id='+id); //chama o arquivo php para excluir o produto
        $('#modalEdit').modal('show'); // chamar o modal
    });
</script>
 
</html>


