<?php 

include '../conn/connect.php';

if($_POST)
{
    $login = $_POST['login'];
    $senha = md5($_POST['senha']); 
    $loginResult = $conn -> query("select * from usuarios where email = '$login' and senha = '$senha' ");
    $rowLogin = $loginResult -> fetch_assoc();
    $numRow = $loginResult -> num_rows;

    //se a sessão não existir
    if(!isset($_SESSION))
    {
        $sessaoAntiga = session_name('login');
        session_start();
        $session_name_new = session_name();
    }

    if($numRow > 0)
    {
        $_SESSION['usuario_id'] = $rowLogin['id'];
        $_SESSION['login_usuario'] = $login;
        $_SESSION['nivel_usuario'] = $rowLogin['nivel'];
        $_SESSION['nome_da_sessao'] = session_name();
        if ($rowLogin['nivel_id'] == '2')
        {
            echo "<script>window.open('index.php','_self')</script>";
            exit();
        }
        else
        {
            echo "<script>window.open('../barbeiro/index.php','_self')</script>";
            exit;
        }
    }
    else
    {
        echo"<p> Login ou senha inválidos. </p>";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="30;URL=../index.php"> <!-- Faz o redirecionamento para o home depois de 30 seg -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2495680ceb.js" crossorigin="anonymous"></script>
    <!-- Link para CSS específico -->
    <link rel="stylesheet" href="../css/estilo.css" type="text/css">
   
    <title>Mustache - Login</title>
</head>
 
<body>
    <main class="container">
        <section>
            <article>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <h1 class="breadcrumb text-info text-center">Faça seu login</h1>
                        <div class="thumbnail">
                            <p class="text-info text-center" role="alert">
                                <i class="fas fa-users fa-10x"></i>
                            </p>
                            <br>
                            <div class="alert alert-info" role="alert">
                                <form action="login.php" name="form_login" id="form_login" method="POST" enctype="multipart/form-data">
                                    <label for="login">Login:</label>
                                    <p class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-user text-info" aria-hidden="true"></span>
                                        </span>
                                        <input type="text" name="login" id="login" class="form-control" autofocus required autocomplete="off" placeholder="Digite seu login.">
                                    </p>
                                    <label for="senha">Senha:</label>
                                    <p class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-qrcode text-info" aria-hidden="true"></span>
                                        </span>
                                        <input type="password" name="senha" id="senha" class="form-control" required autocomplete="off" placeholder="Digite sua senha.">
                                    </p>
                                    <p class="text-right">
                                        <input type="submit" value="Entrar" class="btn btn-primary">
                                    </p>
                                </form>
                                <p class="text-center">
                                    <small>
                                        <br>
                                        Caso não faça uma escolha em 30 segundos será redirecionado automaticamente para página inicial.
                                    </small>
                                </p>
                            </div><!-- fecha alert -->
                        </div><!-- fecha thumbnail -->
                    </div><!-- fecha dimensionamento -->
                </div><!-- fecha row -->
            </article>
        </section>
    </main>
 
 
    <!-- Link arquivos Bootstrap js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
 
</html>