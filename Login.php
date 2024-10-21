<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Lubricantes Chapin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">

    <!-- Verificación de inicio de sesión del usuario -->
    <?php
        $Username = null;
        $Role = isset($_GET["Role"]) ? $_GET["Role"] : null;

        if (!empty($_SESSION["Username"])) {
            $Username = $_SESSION["Username"];
        }
    ?>

    <!-- Estilos adicionales para un mejor diseño -->
    <style>
        body {
            background-color: #f4f4f9;
            color: #333;
        }

        .brand {
            font-size: 3em;
            font-family: 'Josefin Slab', serif;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .address-bar {
            font-size: 1.5em;
            color: white;
            margin-bottom: 20px;
        }

        .navbar {
            background-color: #2c3e50;
        }

        .navbar a {
            color: white !important;
            font-weight: bold;
        }

        .navbar a:hover {
            background-color: #3498db;
        }

        .intro-text {
            color: #2980b9;
            font-weight: bold;
        }

        .form-container {
            margin-top: 30px;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #2980b9;
        }

        .btn-default {
            background-color: #2980b9;
            color: white;
            font-weight: bold;
            border: none;
        }

        .btn-default:hover {
            background-color: #3498db;
        }

        footer {
            background-color: #2c3e50;
            padding: 20px 0;
            color: white;
            text-align: center;
        }
    </style>

</head>

<body>

    <!-- Marca y dirección -->
    <div class="brand">Lubricantes Chapin</div>
    <div class="address-bar"><strong>La mejor tienda de Lubricantes en Cedros</strong></div>

    <!-- Navegación -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Alternar navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Lubricantes Chapin</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="bestseller.php">Productos más populares</a></li>
                    <li><a href="about.php">Nosotros</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario de Login -->
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="text-primary text-center">Ingresar</h2>
                    <hr>
                </div>

                <div class="col-md-6 col-md-offset-3 form-container">
                    <form role="form" action="LoginDestination.php?Role=<?php echo $Role; ?>" method="POST">
                    
                        <div class="form-group">
                            <label for="Username">Usuario:</label>
                            <input type="text" name="Username" class="form-control" id="Username" placeholder="Ingrese su usuario" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="Password">Contraseña:</label>
                            <input type="password" name="Password" class="form-control" id="Password" placeholder="Ingrese su contraseña" required>
                        </div>
                        
                        <button type="submit" class="btn btn-default btn-block">Ingresar</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Lubricantes Chapin</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
