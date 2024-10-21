<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Best Sellers</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <style>
        body {
            background-color: #ffffff; /* Fondo blanco */
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

        .card {
            margin: 15px 0;
            text-align: center; /* Centra el contenido del card */
        }

        .card-img-top {
            height: 200px; /* Ajusta la altura de la imagen */
            width: 200px; /* Ajusta el ancho para hacerla cuadrada */
            object-fit: cover; /* Mantiene la relación de aspecto */
            border-radius: 10%; /* Hace que la imagen sea redonda */
            margin: 0 auto; /* Centra la imagen horizontalmente */
        }

        footer {
            background-color: #2c3e50;
            padding: 20px 0;
            color: white;
            text-align: center;
            flex: 1;
        }
        
    </style>
</head>

<body>
    <div class="brand">Lubricantes Chapin</div>
    <div class="address-bar"><strong>La mejor tienda de lubricantes de cedros</strong></div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Lubricantes Chapin</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="bestseller.php">Productos más Populares</a></li>
                    <li><a href="about.php">Nosotros</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
    <div class="row">
        <?php
            $num = 5;
            require 'Connection.php';

            $sql = "SELECT * FROM tbl_products LIMIT 5";
            $Resulta = mysqli_query($Conn, $sql);

            while ($Rows = mysqli_fetch_array($Resulta)) {
                // Usamos la ruta que se almacena en la base de datos
                $imagePath = $Rows['imagen']; 
                if (!file_exists($imagePath)) {
                    $imagePath = 'uploads/default.jpg';
                }
                echo '
                    <div class="col-md-4 d-flex justify-content-center mb-4">
                        <div class="card" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); background-color: #ffffff;">
                            <img class="card-img-top" src="' . $imagePath . '" alt="Imagen del producto" style="height: 200px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            <div class="card-body text-center">
                                <h5 class="card-title">' . $Rows['nombre'] . '</h5>
                                <p class="card-text">' . $Rows['descripcion'] . '</p>
                                <p class="card-text"><strong>Precio: $</strong>' . number_format($Rows['precio'], 2) . '</p>
                                <p class="card-text"><strong>Stock: </strong>' . $Rows['stock'] . '</p>
                                <a href="ver_productos.php?id=' . $Rows['id'] . '" class="btn btn-primary">Ver producto</a>
                            </div>
                        </div>
                    </div>
                ';
            }
        ?>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa; /* Fondo gris claro para todo el cuerpo */
    }
    .card {
        transition: transform 0.3s; /* Efecto de transición */
    }
    .card:hover {
        transform: scale(1.05); /* Efecto de hover para escalar la tarjeta */
    }
</style>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Lubricantes</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
