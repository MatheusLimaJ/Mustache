<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento Confirmado</title>
    <!-- Inclui o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="images/icon.png" type="icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css" class="css">

</head>

<style>
        .btn-custom {
            background-color: #000; 
            color: #fff; 
            border: none;
            padding: 10px 20px;
            transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #333; 
            color: #f8f9fa; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); 
        }

        .btn-custom:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.5);
        }
    </style>

<body class="fundofixo">

    <!-- Container principal -->
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Agendamento Realizado com Sucesso!</h4>
                    </div>
                    <div class="card-body">
                        <p class="lead">Seu corte foi agendado. Aguardamos você no dia e horário marcado.</p>
                        <hr>
                        <a href="../index.php" class="btn btn-custom">Voltar à Página Inicial</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Inclui o JavaScript do Bootstrap e dependências -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>