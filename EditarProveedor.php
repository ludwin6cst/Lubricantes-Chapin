<?php
session_start();

// Asegúrate de que la sesión esté activa y que el administrador haya iniciado sesión
if (!isset($_SESSION["AdminID"])) {
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smss_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha pasado un ID de proveedor
if (isset($_GET['id'])) {
    $proveedor_id = intval($_GET['id']);

    // Preparar consulta para obtener el proveedor
    $sql = "SELECT * FROM proveedores WHERE proveedor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $proveedor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $proveedor = $result->fetch_assoc();
    } else {
        die("Proveedor no encontrado.");
    }
} else {
    die("ID de proveedor no especificado.");
}

// Manejar la actualización del proveedor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $telefono = $_POST['telefono'];
    $contacto_email = $_POST['contacto_email'];

    // Validar y sanitizar los datos antes de la actualización
    if (!filter_var($contacto_email, FILTER_VALIDATE_EMAIL)) {
        die("Email no válido.");
    }

    // Actualizar el proveedor en la base de datos
    $sql_update = "UPDATE proveedores SET nombre_proveedor = ?, telefono = ?, contacto_email = ? WHERE proveedor_id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssi", $nombre_proveedor, $telefono, $contacto_email, $proveedor_id);

    if ($stmt->execute()) {
        // Redirigir con parámetro de éxito
        header("Location: Proveedores.php?edit=true");
        exit;
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor - Lubricantes Chapin</title>
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

    <!-- Formulario de edición de proveedor -->
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Editar Proveedor</h2>
                    <hr>

                    <form method="POST">
                        <div class="form-group">
                            <label for="nombre_proveedor">Nombre del Proveedor</label>
                            <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor"
                                value="<?php echo htmlspecialchars($proveedor['nombre_proveedor']); ?>" required
                                pattern="[A-Za-z\s]+" title="El nombre del proveedor solo puede contener letras">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" maxlength="9" value="<?php echo htmlspecialchars($proveedor['telefono']); ?>" required pattern="\d{4}-\d{4}" title="Debe ingresar un teléfono en el formato 1234-5678">
                        </div>
                        <div class="form-group">
                            <label for="contacto_email">Email</label>
                            <input type="email" class="form-control" id="contacto_email" name="contacto_email"
                                value="<?php echo htmlspecialchars($proveedor['contacto_email']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
                        <a href="Proveedores.php" class="btn btn-secondary">Volver</a>
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

    <script>

        document.getElementById('nombre_proveedor').addEventListener('input', function (e) {
            let value = e.target.value.replace(/[^a-zA-Z\s]/g, ''); // Eliminar cualquier carácter que no sea letra o espacio
            e.target.value = value;
        });

        document.getElementById('telefono').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');  // Eliminar cualquier cosa que no sea número
            if (value.length > 4) {
                value = value.slice(0, 4) + '-' + value.slice(4);  // Insertar guion después del cuarto dígito
            }
            e.target.value = value.slice(0, 9);  // Limitar a 9 caracteres (incluyendo el guion)
        });
    </script>
</body>

</html>