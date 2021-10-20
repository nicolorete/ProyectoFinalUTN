<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <meta name="language" content="en-EN">


        <link href="https://fonts.googleapis.com/icon?family=Poppins" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
        <link rel="stylesheet" href="css/app.css">
</head>

<body>
      <!-- START NAV -->
      <nav class="navbar columns is-fixed-top" role="navigation" aria-label="main navigation" id="app-header">
    <div class="navbar-brand column is-2 is-paddingless">
        <a class="navbar-item" href="index.html">
            ADMIN
        </a>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="touchMenu">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    
    <div id="touchMenu">
        
    </div>

    <div id="navMenu" class="navbar-menu column is-hidden-touch">
        <!-- <div class="navbar-end">
            <div class="navbar-item">
                <a class="button is-white" onclick="Auth.logout()">
                    <span class="icon">
                        <i class="fa fa-bell"></i>
                    </span>
                </a>
            </div>
            <div class="navbar-item">
                <a class="button is-white" onclick="Auth.logout()">
                    <span class="icon">
                        <i class="fa fa-sign-out"></i>
                    </span>
                </a>
            </div>
        </div> -->
        <div class="navbar-end">
            <div class="navbar-item">
                <a class="button is-white" onclick="Auth.logout()">
                    <span class="icon">
                        <i class="fa fa-lg fa-bell"></i>
                    </span>
                </a>
            </div>
            <div class="navbar-item">
                <a class="button is-white" onclick="Auth.logout()">
                    <span class="icon">
                        <i class="fa fa-lg fa-power-off"></i>
                    </span>
                </a>
            </div>
            <div class="navbar-item has-dropdown">
                <a class="navbar-link">
                    <figure class="image avatar is-32x32">
                        <img class="is-rounded" src="images/user1.png">
                    </figure>
                    &nbsp; Hi, nafplann
                </a>
                <div class="navbar-dropdown is-right">
                    <a class="navbar-item">
                        Overview
                    </a>
                    <a class="navbar-item">
                        Elements
                    </a>
                    <a class="navbar-item">
                        Components
                    </a>
                    <hr class="navbar-divider">
                    <div class="navbar-item">
                        Version 0.7.1
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>        <!-- END NAV -->

    <div class="columns" id="app-content">
        
        <div class="column is-2 is-fullheight is-hidden-touch" id="navigation">
            <aside class="menu">
                <p class="menu-label is-hidden-touch">General</p>
                <ul class="menu-list">
                    <li>
                        <a class="" href="index.html">
                            <span class="icon">
                                <i class="fa fa-home"></i>
                            </span> Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="is-active" href="company-add.php">
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span> Add Company
                        </a>
                    </li>
                    <li>
                        <a class="" href="elements.html">
                            <span class="icon">
                                <i class="fa fa-desktop"></i>
                            </span> UI Elements
                        </a>
                    </li>
                    <li>
                        <a class="" href="datatables.html">
                            <span class="icon">
                                <i class="fa fa-table"></i>
                            </span> Datatables
                        </a>
                    </li>
                </ul>

                <p class="menu-label is-hidden-touch">Sample Pages </p>
                <ul class="menu-list">
                    <li>
                        <a class="" href="login.html">
                            <span class="icon">
                                <i class="fa fa-lock"></i>
                            </span> Login
                        </a>
                    </li>
                </ul>
                <p class="menu-label is-hidden-touch">
                    Sample Page 1 
                </p>
                <p class="menu-label is-hidden-touch">
                    Sample Pages 2
                </p>
            </aside>
        </div>

        <div class="column is-10" id="page-content">
            
            <div class="content-header">
                <h4 class="title is-4">Forms</h4>
                <span class="separator"></span>
                <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="#">Administrar Empresas</a></li>
                        <li class="is-active"><a href="#" aria-current="page">Alta Empresa</a></li>
                    </ul>
                </nav>
            </div>

            <div class="content-body">
                <div class="columns">
                    <div class="column">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Formulario Alta Empresa</p>
                                <form action="../process/cinema-add-process.php" method="POST">
                                    <div class="field">
                                        <label class="label">Cuit</label>
                                        <div class="control">
                                            <input class="input" name="cuit" type="text" placeholder="Cuit de la empresa">
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Nombre</label>
                                        <div class="control">
                                            <input class="input" name="nombre" type="text" placeholder="Nombre"
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Direccion</label>
                                        <div class="control">
                                            <input class="input" name="direccion" type="text" placeholder="Direccion">
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Link</label>
                                        <div class="control">
                                            <input class="input" name="link" type="link" placeholder="Link">
                                        </div>
                                    </div>

                                    <div class="field is-grouped centered" style="padding-left: 30%">
                                        <div class="control">
                                            <button class="button is-link">Registrar</button>
                                        </div>
                                        <div class="control">
                                            <button class="button is-text" type="reset">Limpiar</button>
                                        </div>
                                    </div>
                                </form>       
                            </div>
                        </div>    
                    </div>
                </div>
            </div>

        </div>
    </div>
<!-- <script src="js/app.js"></script>  -->  
</body>

</html>
