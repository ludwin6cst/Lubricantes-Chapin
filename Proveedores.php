<?php 
session_start(); 

// Asegúrate de que la sesión esté activa y que el administrador haya iniciado sesión
if (!isset($_SESSION["AdminID"])) {
    // Si no hay un ID de administrador en la sesión, redirigir al login
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos MySQL
$servername = "localhost";  // Cambia esto si es necesario
$username = "root";         // Usuario de la base de datos
$password = "";             // Contraseña del usuario
$dbname = "smss_db";        // Nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los proveedores de la tabla 'proveedores'
$proveedores = [];
$sql_proveedores = "SELECT proveedor_id, nombre_proveedor, telefono, contacto_email, fecha_registro FROM proveedores";
$result_proveedores = $conn->query($sql_proveedores);

if ($result_proveedores->num_rows > 0) {
    while($row = $result_proveedores->fetch_assoc()) {
        $proveedores[] = $row;  // Almacenar los proveedores en el array
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores - Lubricantes Chapin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
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

        .btn-edit {
        background-color: #5bc0de; 
        color: white;
        border: none;
        padding: 10px 20px; 
        border-radius: 5px; 
        cursor: pointer; 
        font-size: 12px; 
    }

    .btn-edit:hover {
        background-color: #31b0d5;  
    }

    .btn-delete {
        background-color: #d9534f;
        color: white;
        border: none;
        padding: 10px 20px; 
        border-radius: 5px; 
        cursor: pointer; 
        font-size: 12px; 
    }

    .btn-delete:hover {
        background-color: #c9302c; 
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
                        <li><a href="Proveedores.php">Proveedores</a></li>

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
                    <h2 class="intro-text text-center">Lista de Proveedores</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="text-align: center; color: Black; font-weight: bold;">
                                    <th>ID de Proveedor</th>
                                    <th>Nombre del Proveedor</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Fecha de Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($proveedores) > 0): ?>
                                    <?php foreach ($proveedores as $proveedor): ?>
                                        <tr style="color: black">
                                            <td><?php echo htmlspecialchars($proveedor['proveedor_id']); ?></td>
                                            <td><?php echo htmlspecialchars($proveedor['nombre_proveedor']); ?></td>
                                            <td><?php echo htmlspecialchars($proveedor['telefono']); ?></td>
                                            <td><?php echo htmlspecialchars($proveedor['contacto_email']); ?></td>
                                            <td><?php echo htmlspecialchars($proveedor['fecha_registro']); ?></td>
                                            <td class="action-links">
                                                <button class="btn-edit" onclick="ConfirmEdit(<?php echo $proveedor['proveedor_id']; ?>);">Editar</button>
                                                <button class="btn-delete" onclick="DeleteProvider(<?php echo $proveedor['proveedor_id']; ?>);">Eliminar</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No hay proveedores registrados.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Lubricantes Chapin</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

    function ConfirmEdit(id) {
        // Usar SweetAlert2 para la confirmación
        Swal.fire({
            title: '¿Estás seguro de editar este proveedor?',
            text: "Asegúrate de que la información sea correcta.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, editar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, redirigir a la página de edición
                window.location.href = 'EditarProveedor.php?id=' + id;
            }
        });
    }

    function DeleteProvider(id) {
        // Usar SweetAlert2 para la confirmación
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, redirigir a la página de eliminación
                window.location.href = 'EliminarProveedor.php?id=' + id;
            }
        });
    }

    // Mostrar la alerta de éxito si la URL tiene el parámetro success=true
<?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
    Swal.fire({
        title: 'Eliminado',
        text: 'Proveedor eliminado con éxito.',
        icon: 'success',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "Proveedores.php"; // Redirigir después de confirmar
        }
    });
<?php endif; ?>

// Mostrar la alerta de éxito si la URL tiene el parámetro edit=true
<?php if (isset($_GET['edit']) && $_GET['edit'] == 'true'): ?>
    Swal.fire({
        title: 'Editado',
        text: 'Proveedor editado con éxito.',
        icon: 'success',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "Proveedores.php"; // Redirigir después de confirmar
        }
    });
<?php endif; ?>


</script>

</body>

</html>
