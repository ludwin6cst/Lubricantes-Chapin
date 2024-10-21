<?php 
session_start(); 

$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agregar Categoría - Lubricantes Chapin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">

    <?php
    $Username = null;
    $isAdmin = false;

    if (!empty($_SESSION["Username"])) {
        $Username = $_SESSION["Username"];
    }

    if (!empty($_SESSION['Admin'])) {
        $isAdmin = true;
    } else {
        echo '<script>window.open("index.php","_self",null,true);</script>';
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre_categoria = $_POST['nombre_categoria'];
        $estado = $_POST['estado'];

        // Manejo de la imagen
        $imagen = $_FILES['imagen'];
        $imagen_nombre = $imagen['name'];
        $imagen_temporal = $imagen['tmp_name'];
        $ruta_destino = 'uploads/' . $imagen_nombre;

        // Mueve la imagen a la carpeta de destino
        if (move_uploaded_file($imagen_temporal, $ruta_destino)) {
            // Insertar datos en la base de datos
            require 'Connection.php';

            $sql = "INSERT INTO categorias (nombre_categoria, imagen, estado) VALUES ('$nombre_categoria', '$ruta_destino', '$estado')";
            if (mysqli_query($Conn, $sql)) {
                // Redirigir con mensaje de éxito
                header("Location: Agregar_ctg.php?mensaje=Categoría agregada exitosamente&tipo=success");
                exit();
            } else {
                // Redirigir con mensaje de error
                header("Location: Agregar_ctg.php?mensaje=Error al agregar categoría: " . mysqli_error($Conn) . "&tipo=danger");
                exit();
            }
        } else {
            // Redirigir con mensaje de error de imagen
            header("Location: Agregar_ctg.php?mensaje=Error al subir la imagen.&tipo=danger");
            exit();
        }
    }
    ?>

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

        .form-group {
            margin-bottom: 30px;
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

    <div class="brand">Lubricantes Chapin</div>
    <div class="address-bar"><strong>La mejor tienda de Lubricantes en Cedros</strong></div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Alternar navegación</span>
                    <span class="icon-bar"></s>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                    <a class="navbar-brand" href="index.php">Lubricantes Chapin</a>
            </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-center">
                        <li><a href="Categorias.php">Categorias</a></li>

                        <!-- Menú desplegable con hover -->
                        <li class="dropdown" id="admin-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                            Administradores <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                                <li><a href="Management_Customers.php">Administradores</a></li>
                                <li><a href="Management_ProductsList.php">Lista de Productos</a></li>
                                <li><a href="pedidos.php">Realizar pedido</a></li>
                                <li><a href="Management_Orders.php">Pedidos</a></li>
                                <li><a href="Agregar_ctg.php">Agregar Categoría</a></li>
                                <li><a href="Categorias.php">Categorias</a></li>
                                <li><a href="Agregar_prv.php">Agregar Proveedor</a></li>
                                <li><a href="Proveedores.php">Proveedores</a></li>
                                <li><a href="register.php">Registrar Administrador</a></li>
                                <li><a href="Management_Products.php?ProductAction=Add">Agregar Productos</a></li>
                                <?php 
                                    $Username = isset($_SESSION['Username']) ? $_SESSION['Username'] : null;
                                    if($Username == null) { 
                                        echo '<li><a href="register.php?ActionType=Register">Registrar administradores</a></li>'; 
                                    } 
                                ?>
                            </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!-- Estilos adicionales -->
<style>
    /* Estilo general de la barra de navegación */
    .navbar {
        background-color: #2c3e50; /* Azul oscuro */
        border: none;
        border-radius: 0;
        font-size: 15px; /* Tamaño de fuente más grande */
        padding: 20px 0; /* Más padding para hacer la barra más alta */
    }

    /* Aumenta el tamaño de los enlaces */
    .navbar-nav > li > a {
        color: #2c3e50;
        font-weight: bold;
        font-size: 15px; /* Texto más grande */
        padding: 20px;
        justify-content: center; /* Aumenta el espacio alrededor de los enlaces */
    }

    /* Estilo cuando pasas el cursor por los enlaces */
    .navbar-nav > li > a:hover {
        background-color: #2c3e50; /* Azul más claro */
        color: white;
    }

    /* Menú desplegable en hover */
    #admin-dropdown:hover .dropdown-menu {
        display: block;
        background-color: #2c3e50; /* Azul medio */
        border-radius: 0;
    }

    /* Estilo de los elementos del menú desplegable */
    .dropdown-menu > li > a {
        color: #fff;
        padding: 15px 30px; /* Aumenta el espacio en los elementos del menú */
        font-size: 10px; /* Tamaño de texto del dropdown */
    }

    .dropdown-menu > li > a:hover {
        background-color: #0052a3; /* Azul más oscuro */
    }

    /* Centra el contenido del navbar */
    .navbar-nav {
        display: flex;
        justify-content: center; /* Centra horizontalmente */
    }

    /* Centra el caret (flecha) del menú desplegable */
    .caret {
        border-top: 6px solid white; /* Hace el caret más grande */
    }

    /* Menú desplegable con animación */
    .dropdown-menu {
        transition: all 0.3s ease-in-out;
        margin-top: 0;
    }
</style>

<div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Agregar Categoría</h2>
                    <hr>

                    <!-- Formulario para agregar categoría -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nombre Categoría</label>
                            <input type="text" class="form-control" name="nombre_categoria" required>
                        </div>

                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*" required>
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control" name="estado" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Agregar Categoría</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Lubricantes Chapin</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Mostrar SweetAlert2 con el mensaje si está presente
        <?php if (!empty($mensaje)): ?>
            Swal.fire({
                title: '<?= $mensaje; ?>',
                icon: '<?= $tipo; ?>',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir después de mostrar la alerta
                    window.location.href = 'Categorias.php';
                }
            });
        <?php endif; ?>
    </script>

    <!-- Bootstrap JS -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
function getNextCategoryId() {
    require 'Connection.php'; // Asegúrate de que este archivo contenga la conexión a la base de datos

    $sql = "SELECT MAX(categoria_id) AS max_id FROM categorias";
    $result = mysqli_query($Conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    return $row['max_id'] + 1; // Retorna el siguiente ID disponible
}
?>
