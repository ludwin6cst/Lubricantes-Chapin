<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>About</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

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

        .table-responsive {
            margin-top: 30px;
        }

        table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #ecf0f1;
        }

        img {
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .action-links a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        .action-links a:hover {
            color: #c0392b;
        }

        footer {
            background-color: #2c3e50;
            padding: 20px 0;
            color: white;
            text-align: center;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php
		$Username = null;
		if(!empty($_SESSION["Username"]))
		{
			$Username = $_SESSION["Username"];
		}
	?>
</head>

<body>

    <div class="brand">Lubricantes Chapin</div>
    <div class="address-bar"><strong>La mejor tienda de lubricantes para autos</strong></div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Lubricantes cxHAPIN</a>
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

    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Nosotros
                        <strong>Lubricantes Chapin</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-6">
                    <img class="img-responsive img-border-left" src="img/logo.png" alt="">
                </div>
                <div class="col-md-6">
                    <p>Este sistema sencillo y eficiente está diseñado para gestionar de manera óptima el control de stock y la venta de lubricantes para autos, sin intermediarios. El código de la aplicación es de libre uso y distribución, brindando apoyo a quienes buscan soluciones digitales rápidas y eficientes.</p>
                    <p><a href="http://localhost/lubricantes-chapin/index.php"><b>Lubricantes Chapin</b></a> se especializa en la gestión de productos automotrices, integrando soluciones de software personalizadas para facilitar el control de inventarios, pedidos, y ventas en tiempo real.</p>
                    <p>Nuestros lubricantes están diseñados para maximizar el rendimiento de los motores y prolongar su vida útil, reduciendo el desgaste y mejorando la eficiencia. Con nuestro sistema, los usuarios pueden monitorear la disponibilidad de cada producto en tiempo real, realizar pedidos de manera rápida y eficiente, y mantener un control preciso del inventario.</p>
                    <p>Además, trabajamos constantemente en la incorporación de nuevas tecnologías para optimizar la entrega y distribución, ofreciendo soluciones a medida para talleres, concesionarios y consumidores finales. En Lubricantes cxHAPIN, nuestra misión es brindar un servicio de calidad respaldado por productos confiables y un sistema de gestión avanzado.</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>
                        <?php echo '<strong>'.$Username.'</strong>'; ?>
                        <br>
                        <strong>
                        <?php if($Username != null){echo '<a href="ManageAccount.php?Role=Admin">Manage Account</a> |';} ?> 
                        <?php if($Username == null){echo '<a href="Login.php?Role=Admin">Login</a>';} else {echo '<a href="Logout.php">Logout</a>';} ?> | 
                        <a href="#">Volver arriba</a>
                        </strong><br>
                        Copyright &copy; Lubricantes Chapin
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<script>
		function ManagementOnclick(){
			if(confirm("Solo los administradores tienen permitido acceder a esta página. Inicie sesión como administrador.") == true)
			{
				window.open("Login.php?Role=Admin","_self",null,true);
			}
		}
    </script>

</body>

</html>
