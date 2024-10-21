<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Detalle del Producto</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet" type="text/css">

    <style>
        body {
            background-color: #ffffff;
            color: #333;
        }

        .brand {
            font-size: 3em;
            font-family: 'Josefin Slab', serif;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
            margin-top: 30px;
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

        .product-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
            text-align: center;
        }

        .product-image {
            height: 300px;
            width: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .product-details {
            margin-top: 20px;
        }

        .product-title {
            font-size: 2em;
            color: #2c3e50;
        }

        .product-description {
            color: #7f8c8d;
            font-size: 1.2em;
            margin-top: 10px;
        }

        .product-price {
            font-size: 1.5em;
            color: #2980b9;
            margin-top: 20px;
        }

        .product-stock {
            color: #27ae60;
            font-size: 1.3em;
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
    <div class="brand">Detalle del Producto</div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Lubricantes Chapin</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="bestseller.php">Productos Populares</a></li>
                <li><a href="about.php">Nosotros</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php
        require 'Connection.php';
        
        // Verificar si el id del producto está presente en la URL
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];

            // Obtener el producto de la base de datos basado en el ID
            $sql = "SELECT * FROM tbl_products WHERE id = $product_id";
            $result = mysqli_query($Conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Verificar si la imagen existe
                $imagePath = $row['imagen'];
                if (!file_exists($imagePath)) {
                    $imagePath = 'uploads/default.jpg';
                }

                echo '
                    <div class="product-container">
                        <img class="product-image" src="' . $imagePath . '" alt="Imagen del producto">
                        <div class="product-details">
                            <h2 class="product-title">' . $row['nombre'] . '</h2>
                            <p class="product-description">' . $row['descripcion'] . '</p>
                            <p class="product-price"><strong>Precio: $</strong>' . number_format($row['precio'], 2) . '</p>
                            <p class="product-stock"><strong>Stock disponible: </strong>' . $row['stock'] . '</p>
                        </div>
                    </div>
                ';
            } else {
                echo '<p class="text-center">Producto no encontrado.</p>';
            }
        } else {
            echo '<p class="text-center">No se ha especificado un producto.</p>';
        }
        ?>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>&copy; 2024 Lubricantes Chapin</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
