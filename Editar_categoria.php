<?php
require 'Connection.php';

// Verificar si se ha pasado el ID por la URL
if (isset($_GET['id'])) {
    $categoria_id = $_GET['id'];

    // Consulta para obtener los datos de la categoría
    $sql = "SELECT * FROM categorias WHERE categoria_id = ?";
    $stmt = $Conn->prepare($sql);
    $stmt->bind_param('i', $categoria_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $categoria = $result->fetch_assoc();

    if (!$categoria) {
        die('Categoría no encontrada.');
    }
} else {
    die('ID de categoría no proporcionado.');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría - Lubricantes Chapin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
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

        .form-control {
            margin-bottom: 15px;
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
                <ul class="nav navbar-nav navbar-center">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="Categorias.php">Categorias</a></li>
                    <li class="dropdown" id="admin-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                            Administradores <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="Management_Customers.php">Administradores</a></li>
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

    <!-- Estilos adicionales para el diseño de navegación -->
    <style>
        .navbar {
            background-color: #2c3e50;
            border: none;
            border-radius: 0;
            font-size: 15px;
            padding: 20px 0;
        }

        .navbar-nav > li > a {
            color: #2c3e50;
            font-weight: bold;
            font-size: 15px;
            padding: 20px;
            justify-content: center;
        }

        .navbar-nav > li > a:hover {
            background-color: #2c3e50;
            color: white;
        }

        #admin-dropdown:hover .dropdown-menu {
            display: block;
            background-color: #2c3e50;
            border-radius: 0;
        }

        .dropdown-menu > li > a {
            color: #fff;
            padding: 15px 30px;
            font-size: 10px;
        }

        .dropdown-menu > li > a:hover {
            background-color: #0052a3;
        }

        .navbar-nav {
            display: flex;
            justify-content: center;
        }

        .caret {
            border-top: 6px solid white;
        }

        .dropdown-menu {
            transition: all 0.3s ease-in-out;
            margin-top: 0;
        }
    </style>

    <!-- Formulario de edición de categoría -->
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Editar Categoría</h2>
                    <hr>

                    <?php if (isset($_GET['mensaje'])): ?>
                        <div class="alert alert-<?php echo $_GET['tipo']; ?>">
                            <?php echo $_GET['mensaje']; ?>
                        </div>
                    <?php endif; ?>

                    <form action="Editar_categoria_Action.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>ID Categoría</label>
                            <input type="text" class="form-control" name="categoria_id" value="<?php echo $categoria['categoria_id']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nombre Categoría</label>
                            <input type="text" class="form-control" name="nombre_categoria" value="<?php echo htmlspecialchars($categoria['nombre_categoria']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*">
                            <?php if (!empty($categoria['imagen'])): ?>
                                <img src="<?php echo htmlspecialchars($categoria['imagen']); ?>" alt="Imagen Actual" class="img-category" style="margin-top: 10px;">
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control" name="estado" required>
                                <option value="1" <?php echo $categoria['estado'] == 1 ? 'selected' : ''; ?>>Activo</option>
                                <option value="0" <?php echo $categoria['estado'] == 0 ? 'selected' : ''; ?>>Inactivo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
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

    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Comprobar si hay parámetros de éxito o error en la URL
        const urlParams = new URLSearchParams(window.location.search);
        const mensaje = urlParams.get('mensaje');
        const tipo = urlParams.get('tipo');

        if (mensaje) {
            Swal.fire({
                icon: tipo === 'success' ? 'success' : 'error',
                title: tipo === 'success' ? 'Éxito' : 'Error',
                text: mensaje,
                confirmButtonText: 'Aceptar'
            });
        }
    </script>
</body>

</html>
