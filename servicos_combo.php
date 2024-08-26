<?php 
    include 'conn/connect.php';
    $lista = $conn -> query('select * from vw_servicos where categoria_id = 4'); // diferente de combos
    $row = $lista -> fetch_assoc();
    $num_linhas = $lista -> num_rows;

    $listaCa = $conn -> query('select * from categorias');
    $row_ca = $listaCa -> fetch_assoc();


?>


<?php 
    if($num_linhas == 0)
    {?>
        <h2 class="breadchrumb alert-danger">
            Não há serviços cadstrados!
            
        </h2>
<?php } ?>

<?php 
if($num_linhas > 0){?>
    <div class="col-xs-12 text-center">        
        <h2 class="breadcrumb alert-white">
            Conheça os combos!
        </h2>
    </div>

    <div class="row">
        <?php do{ ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <a href="servico_detalhes.php?id=<?php echo $row['id'] ?>">
                        <img src="images/<?php echo $row['imagem']?>" alt="" class="img-responsive img-rounded">
                    </a>
                    <div class="caption text-left">
                        <h3 class="text-dark text-center">
                            <strong><?php echo $row['nome'];?></strong>
                        </h3>

                        <p class="text-primary text-center">
                            <strong><?php echo $row['categoria_descricao'];?></strong>
                        </p>
                        
                        <p class="text-dark text-center">
                            <?php echo mb_Strimwidth($row['detalhe'],0,45, '...')?>
                        </p>
                        <p>
                            <button class="btn btndefault disabled">
                            <?php echo "R$ " . number_format($row['valor_unit'],2,',','.') ?>
                            </button>
                        </p>
                    </div>
                    <div class="caption text-right">
                    
                        <p>
                                <a href="servico_detalhes.php?id=<?php echo $row['id'];?>">
                                    <button id="atencao" type="button" class="btn btn-default btn-lg"> Saiba mais
                            
                                    </button>
                                </a>
                        </p>
                    </div>
                </div>
            </div>
           <?php }while($row = $lista -> fetch_assoc()); ?>

    </div>
    
<?php }?>