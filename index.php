<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lubricantes Chapin</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;300;400;600;700&family=Open+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    $Username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;
    ?>

    <!-- Estilos adicionales -->
    <style>
        body {
            font-family: 'Josefin Sans', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 2rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        header h1 {
            font-weight: 700;
            letter-spacing: 2px;
        }

        .navbar {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.8rem;
        }

        /* Estilos del carrusel */
        .carousel {
            margin: 2rem auto;
            width: 90%;
            max-width: 1200px;
            border-radius: 15px;
            overflow: hidden;
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
        }

        .carousel-indicators button {
            background-color: #ffc107;
        }

        .card {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body h5 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-footer a {
            font-weight: 600;
        }

        footer {
            background-color: #212529;
            color: #f8f9fa;
            padding: 2rem 0;
            margin-top: 3rem;
            text-align: center;
        }

        footer p,
        footer a {
            font-size: 0.9rem;
            margin: 0.5rem 0;
        }

        footer a {
            color: #ffc107;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .card {
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.product-image {
    height: 200px; /* Ajusta esta altura según tus necesidades */
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.product-image {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px; /* Ajusta esta altura según sea necesario */
    overflow: hidden;
}

.product-image img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover; /* Asegura que la imagen llene el espacio sin distorsión */
    display: block;
}


.card-body h5 {
    margin-bottom: 15px;
    font-size: 1.2rem;
}

.card-footer a {
    transition: background-color 0.3s, box-shadow 0.3s;
}

.card-footer a:hover {
    background-color: #0056b3;
    box-shadow: 0 5px 15px rgba(0, 85, 170, 0.3);
}

.text-success {
    font-weight: bold;
}

.text-primary {
    color: #007bff;
    font-size: 1.5rem;
}


        .btn-primary:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
    </style>
</head>

<body>

    <!-- Encabezado -->
    <header>
        <h1>Lubricantes Chapin</h1>
        <p><strong>La mejor tienda de Lubricantes en Cedros</strong></p>
    </header>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <!-- Logo aquí -->
                <img src="img/logo.png" alt="Logo" width="70" height="70" class="d-inline-block align-text-top me-2">
                Lubricantes Chapin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="bestseller.php">Productos más Populares</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="ManagementOnclick();">Administrador</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sección del carrusel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                class="active"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slide1.png" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="img/slide2.png" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="img/slide-3.png" class="d-block w-100" alt="Slide 3">
            </div>
            <div class="carousel-item">
                <img src="img/slide4.png" class="d-block w-100" alt="Slide 4">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!-- Sección de productos -->
    <div class="container my-5">
        <div class="row">
            <?php
            // Conexión a la base de datos
            $conn = mysqli_connect("localhost", "root", "", "smss_db");
            if (!$conn) {
                die("Conexión fallida: " . mysqli_connect_error());
            }
            
            $sql = "SELECT p.*, c.nombre_categoria FROM `tbl_products` p
            JOIN `categorias` c ON p.id_categoria = c.categoria_id"; // Asegúrate de que `id` sea la clave primaria de la tabla `categorias`
            $Resulta = mysqli_query($conn, $sql);

            while ($Rows = mysqli_fetch_array($Resulta)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden">
                        <div class="product-image bg-light">
                            <img src="<?php echo $Rows['imagen']; ?>" alt="Producto">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title font-weight-bold text-primary"><?php echo htmlspecialchars($Rows['nombre']); ?></h5>
                            <p class="card-text"><strong>Descripción:</strong> 
                                <?php echo htmlspecialchars($Rows['descripcion']); ?>
                            </p>
                            <p class="card-text"><strong>Precio:</strong> 
                                <span class="text-success">$<?php echo htmlspecialchars($Rows['precio']); ?></span>
                            </p>
                            <p class="card-text"><strong>Categoría:</strong> 
                                <?php echo htmlspecialchars($Rows['nombre_categoria']); ?>
                            </p>
                            <p class="card-text"><strong>Estado:</strong> 
                                <span class="<?php echo $Rows['estado'] == 1 ? 'text-success' : 'text-danger'; ?>">
                                    <?php echo ($Rows['estado'] == 1 ? 'Disponible' : 'No Disponible'); ?>
                                </span>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent text-center border-0">
                            <a href="ver_productos.php?id=<?php echo $Rows['id']; ?>" class="btn btn-primary btn-sm rounded-pill px-4">Ver producto</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <p>Lubricantes Chapin &copy; 2024 - Todos los derechos reservados.</p>
        <p><a href="#">Política de privacidad</a> | <a href="#">Términos de uso</a></p>
    </footer>

    <!-- JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Función personalizada con SweetAlert2 -->
    <script>
        function ManagementOnclick() {
            // Siempre permitir el acceso a la página de administración
            Swal.fire({
                title: 'Redirigiendo',
                text: 'Serás redirigido a la página de administración.',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = 'Login.php?Role=Admin';
            });
        }
    </script>


</body>

</html>