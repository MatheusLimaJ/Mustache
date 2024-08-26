
<!-- BOOTSTRAP -->
<!-- abre a barra de navegação -->


<nav class="navbar navbar-expanded-md navbar-fixed-top navbar-light navbar-inverse"> 
    <div class="container-fluid">
        <!-- agrupamento Mobile -->
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#menupublico" aria-expanded="false">
                <span class="sr-only"> Toggle Navigation </span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
    
                <img id="logo-nav" src="images/logo-white.png" alt="Logotipo Mustache">
        
        </div>
        <!-- Fecha agrupamento Mobile -->
        <!-- nav direita -->
        <div class="collapse navbar-collapse" id="menupublico">
            <ul id="navbar-center" class="nav navbar-nav">
                <li>
                    <a href="index.php#reservar"> AGENDAR </a>
                </li>
    
                <li>
                    <a href="index.php#produtos"> SERVIÇOS </a>
                </li>
                <!-- Dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        CATEGORIAS
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        
                    </ul>
                </li>
                <li>
                    <a href="index.php#contato"> CONTATO </a>
                </li>

            </ul>
        
        
            <ul class="nav navbar-nav navbar-right">
                <li class="active">
                    <a href="index.php">
                        <span class="glyphicon glyphicon-home"></span>
                    </a>
                </li>

                <!-- início formulario de busca  -->
                <form action="produtos_busca.php" method="get" name="form-busca"
                    id="form-busca" class="navbar-form navbar-left" role="search">
                        <div class="input-group">
                            <input type="search" name="buscar" id="buscar" size="9" class="form-control"
                            aria-label="search" placeholder="Buscar produto" required>
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                </form>
                <!-- fim formulario de busca  -->
                <li id="loginzada" class="nav-item">
            
                    <form id="login-cad"class="form-inline">
                        <a href="">
                            <button class="btn btn-outline-success" type="button">Cadastre-se</button>
                        </a>
                        <a href="entrar.php">
                            <button class="btn btn-sm btn-outline-secondary" type="button">Entrar</button>
                        </a>
                    </form>

                </li>
                

            </ul>
        </div>
    </div>
</nav>
