<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root"; // Usuario de MySQL
$password = ""; // Contraseña de MySQL
$dbname = "smss_db"; // Nombre de la base de datos

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar ID del producto de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obtener los datos del producto
    $sql = "SELECT * FROM tbl_products WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener los datos del producto
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $stock = $row['stock'];
        $id_categoria = $row['id_categoria'];
        $imagen = $row['imagen'];
        $estado = $row['estado'];
        $marca = $row['marca'];
        $fecha_agregado = $row['fecha_agregado'];
    } else {
        echo "Producto no encontrado";
    }
} else {
    echo "ID no proporcionado";
}

// Consulta para obtener todas las categorías
$categorias_sql = "SELECT categoria_id, nombre_categoria FROM categorias";
$categorias_result = $conn->query($categorias_sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Lubricantes Chapin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <!-- Marca y dirección -->
    <div class="brand">Lubricantes Chapin</div>
    <div class="address-bar"><strong>La mejor tienda de Lubricantes en Cedros</strong></div>

    <!-- Navegación -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Alternar navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Lubricantes Chapin</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-center">
                    <li><a href="Management_ProductsList.php">Lista de Productos</a></li>
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
                            if ($Username == null) {
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

        .navbar-nav>li>a {
            color: #2c3e50;
            font-weight: bold;
            font-size: 15px;
            padding: 20px;
            justify-content: center;
        }

        .navbar-nav>li>a:hover {
            background-color: #2c3e50;
            color: white;
        }

        #admin-dropdown:hover .dropdown-menu {
            display: block;
            background-color: #2c3e50;
            border-radius: 0;
        }

        .dropdown-menu>li>a {
            color: #fff;
            padding: 15px 30px;
            font-size: 10px;
        }

        .dropdown-menu>li>a:hover {
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

    <!-- Formulario de edición de producto -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Contenedor del formulario con fondo blanco y borde -->
                <div class="card" style="background-color: white; padding: 20px; border-radius: 8px;">
                    <hr>
                    <h2 class="intro-text text-center">Editar Producto</h2>
                    <hr>
                    <form action="Edit_Product.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="nombre"
                                value="<?php echo htmlspecialchars($nombre); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" name="descripcion" rows="2"
                                required><?php echo htmlspecialchars($descripcion); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" step="0.01" min="0" class="form-control" name="precio" value="<?php echo $precio; ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" class="form-control" name="stock" min="0" value="<?php echo $stock; ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="id_categoria">Categoría:</label>
                            <select class="form-control" name="id_categoria" required>
                                <option value="">Selecciona una categoría</option>
                                <?php
                                if ($categorias_result->num_rows > 0) {
                                    while ($categoria = $categorias_result->fetch_assoc()) {
                                        // Verificar si es la categoría seleccionada del producto actual
                                        $selected = ($categoria['categoria_id'] == $id_categoria) ? 'selected' : '';
                                        echo "<option value='{$categoria['categoria_id']}' $selected>{$categoria['nombre_categoria']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen (dejar vacío para no cambiar):</label>
                            <input type="file" class="form-control" name="imagen">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select class="form-control" name="estado" required>
                                <option value="1" <?php echo ($estado == 1) ? 'selected' : ''; ?>>Disponible</option>
                                <option value="0" <?php echo ($estado == 0) ? 'selected' : ''; ?>>Agotado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca:</label>
                            <input type="text" class="form-control" name="marca"
                                value="<?php echo htmlspecialchars($marca); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_agregado">Fecha Agregado:</label>
                            <input type="date" class="form-control" name="fecha_agregado" id="fecha_agregado"
                                value="<?php echo $fecha_agregado; ?>" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Actualizar Producto</button>
                        <a href="Management_ProductsList.php" class="btn btn-secondary">Volver</a>
                    </form>
                </div>

                <?php
                if (isset($_POST['submit'])) {
                    // Obtener los valores del formulario
                    $nombre = $_POST['nombre'];
                    $descripcion = $_POST['descripcion'];
                    $precio = $_POST['precio'];
                    $stock = $_POST['stock'];
                    $id_categoria = $_POST['id_categoria'];
                    $estado = $_POST['estado'];
                    $marca = $_POST['marca'];
                    $fecha_agregado = $_POST['fecha_agregado'];

                    // Procesar la imagen
                    if (!empty($_FILES['imagen']['name'])) {
                        $imagen = $_FILES['imagen']['name'];
                        $target_dir = "uploads/";
                        $target_file = $target_dir . basename($imagen);
                        move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file);

                        // Incluir imagen en la consulta de actualización
                        $sql = "UPDATE tbl_products SET nombre='$nombre', descripcion='$descripcion', precio=$precio, stock=$stock, id_categoria=$id_categoria, imagen='$target_file', estado=$estado, marca='$marca', fecha_agregado='$fecha_agregado' WHERE id=$id";
                    } else {
                        // Sin cambios en la imagen
                        $sql = "UPDATE tbl_products SET nombre='$nombre', descripcion='$descripcion', precio=$precio, stock=$stock, id_categoria=$id_categoria, estado=$estado, marca='$marca', fecha_agregado='$fecha_agregado' WHERE id=$id";
                    }

                    // Ejecutar la consulta
                    if ($conn->query($sql) === TRUE) {
                        echo '<script>
                        Swal.fire({
                            title: "Producto actualizado correctamente",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "Management_ProductsList.php";
                            }
                        });
                    </script>';
                    } else {
                        echo '<script>Swal.fire("Error al actualizar el producto: ' . $conn->error . '");</script>';
                    }

                }
                ?>

            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Obtener la fecha actual en formato YYYY-MM-DD
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
        var yyyy = today.getFullYear();
        
        // Formato final de la fecha
        var maxDate = yyyy + '-' + mm + '-' + dd;
        
        // Asignar la fecha máxima al campo de fecha
        document.getElementById("fecha_agregado").setAttribute("max", maxDate);
    });
</script>



    <footer>
        <div class="container">
            <p>© 2024 Lubricantes Chapin. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="js/bootstrap.min.js"></script>


</body>

</html>