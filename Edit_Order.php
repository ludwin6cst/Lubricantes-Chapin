<?php
session_start();
require 'Connection.php'; // Conexión a la base de datos

// Verificar si se ha recibido un ID de pedido
if (isset($_GET['id'])) {
    $id_pedido = $_GET['id'];
    
    // Preparar la consulta para obtener los datos del pedido
    $sqlSelect = "SELECT * FROM pedidos WHERE id_pedido = ?";
    if ($stmtSelect = mysqli_prepare($Conn, $sqlSelect)) {
        mysqli_stmt_bind_param($stmtSelect, 'i', $id_pedido);
        mysqli_stmt_execute($stmtSelect);
        $result = mysqli_stmt_get_result($stmtSelect);
        
        if ($row = mysqli_fetch_assoc($result)) {
            // Almacenar los datos del pedido en variables
            $nombre_producto = $row['nombre_producto'];
            $categoria_id = $row['categoria_id'];
            $CustomerID = $row['CustomerID'];
        } else {
            echo "Pedido no encontrado.";
            exit;
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmtSelect);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($Conn);
        exit;
    }

    // Obtener todas las categorías
    $sqlCategorias = "SELECT categoria_id, nombre_categoria FROM categorias";
    $categorias = mysqli_query($Conn, $sqlCategorias);
} else {
    echo "ID de pedido no especificado.";
    exit;
}

// Cerrar la conexión
$Conn->close();
?>

<?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
    <script>
        Swal.fire({
            title: 'Pedido Editado',
            text: 'Pedido editado correctamente.',
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    </script>
<?php endif; ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido - Lubricantes Chapin</title>
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
                    <li><a href="Categorias.php">Categorías</a></li>
                    <li class="dropdown" id="admin-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                            Administradores <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="Management_Customers.php">Administradores</a></li>
                            <li><a href="pedidos.php">Realizar pedido</a></li>
                            <li><a href="Management_Orders.php">Pedidos</a></li>
                            <li><a href="Agregar_ctg.php">Agregar Categoría</a></li>
                            <li><a href="Categorias.php">Categorías</a></li>
                            <li><a href="Agregar_prv.php">Agregar Proveedor</a></li>
                            <li><a href="Proveedores.php">Proveedores</a></li>
                            <li><a href="register.php">Registrar Administrador</a></li>
                            <li><a href="Management_Products.php?ProductAction=Add">Agregar Productos</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario de edición de pedido -->
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Editar Pedido</h2>
                    <hr>

                    <form action="Management_Orders_Action.php" method="POST">
                        <div class="form-group">
                            <label>ID Pedido</label>
                            <input type="text" class="form-control" name="id_pedido" value="<?php echo $id_pedido; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nombre Producto</label>
                            <input type="text" class="form-control" name="nombre_producto" value="<?php echo htmlspecialchars($nombre_producto); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Categoría</label>
                            <select class="form-control" name="categoria_id">
                                <?php while ($categoria = mysqli_fetch_assoc($categorias)): ?>
                                    <option value="<?php echo $categoria['categoria_id']; ?>" <?php echo $categoria['categoria_id'] == $categoria_id ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($categoria['nombre_categoria']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ID Administrador</label>
                            <input type="text" class="form-control" name="CustomerID" value="<?php echo htmlspecialchars($CustomerID); ?>" required disabled>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Pedido</button>
                        <a href="Management_Orders.php" class="btn btn-secondary">Volver</a>
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
