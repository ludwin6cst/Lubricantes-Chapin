<?php 
session_start(); 

if (!isset($_SESSION["AdminID"])) {

    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'Admin') {
    echo 'No tienes permiso para acceder a esta página.';
    exit();
}

$customer_id = $_SESSION["AdminID"];  

$servername = "localhost";  
$username = "root";         
$password = "";            
$dbname = "smss_db";        

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$categorias = [];
$sql_categorias = "SELECT categoria_id, nombre_categoria FROM categorias WHERE estado = 1"; 
$result_categorias = $conn->query($sql_categorias);

if ($result_categorias->num_rows > 0) {
    while ($row = $result_categorias->fetch_assoc()) {
        $categorias[] = $row;  
    }
}


$proveedores = [];
$sql_proveedores = "SELECT proveedor_id, nombre_proveedor FROM proveedores";
$result_proveedores = $conn->query($sql_proveedores);

if ($result_proveedores->num_rows > 0) {
    while($row = $result_proveedores->fetch_assoc()) {
        $proveedores[] = $row;  
    }
}

$sql_last_id = "SELECT MAX(id_pedido) AS last_id FROM pedidos";
$result_last_id = $conn->query($sql_last_id);
$next_id = 1; 

if ($result_last_id->num_rows > 0) {
    $row = $result_last_id->fetch_assoc();
    $next_id = $row['last_id'] + 1; 
}

$pedido_agregado = false;  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_producto = $_POST['nombre_producto'];
    $fecha_pedido = $_POST['fecha_pedido'];
    $categoria_id = $_POST['categoria_id']; 
    $proveedor_id = $_POST['proveedor_id'];

    $sql = "INSERT INTO pedidos (nombre_producto, CustomerID, fecha_pedido, categoria_id, proveedor_id) VALUES ('$nombre_producto', '$customer_id', '$fecha_pedido', '$categoria_id', '$proveedor_id')";
    
    if ($conn->query($sql) === TRUE) {
        $pedido_agregado = true; 
    } else {
        echo "<div class='alert alert-danger'>Error al agregar el pedido: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pedido - Lubricantes Chapin</title>
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
            color: whie;
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
                    <span class="icon-bar"></s>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                    <a class="navbar-brand" href="index.php">Lubricantes Chapin</a>
            </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-center">
                        <li><a href="Management_Orders.php">Pedidos</a></li>

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

    <!-- Formulario de agregar pedido -->
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Agregar Pedido</h2>
                    <hr>
                </div>

                <div class="col-md-12">
                    <form role="form" method="POST" action="pedidos.php">
                        <div class="col-md-6">
                            <!-- Campo ID Pedido (bloqueado) -->
                            <div class="form-group">
                                <label for="id_pedido">ID Pedido:</label>
                                <input type="text" id="id_pedido" name="id_pedido" class="form-control"
                                    value="<?php echo $next_id; ?>" disabled>
                            </div>

                            <!-- Campo Nombre Producto -->
                            <div class="form-group">
                                <label for="nombre_producto">Nombre del Producto:</label>
                                <input type="text" id="nombre_producto" name="nombre_producto" class="form-control"
                                    placeholder="Ingresa el nombre del producto" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Campo ID Admin -->
                            <div class="form-group">
                                <label for="CustomerID">ID del Administrador:</label>
                                <!-- El campo está bloqueado y se muestra el id del admin de la sesión -->
                                <input type="text" name="customer_id" class="form-control" id="CustomerID"
                                    value="<?php echo $customer_id; ?>" disabled>
                            </div>
                            <!-- Campo Fecha Pedido -->
                            <div class="form-group">
                                <label for="fecha_pedido">Fecha del Pedido:</label>
                                <input type="date" id="fecha_pedido" name="fecha_pedido" class="form-control" required>
                            </div>

                            <!-- Campo Categoría (combobox) -->
                            <div class="form-group">
                                <label for="categoria_id">Categoría:</label>
                                <select id="categoria_id" name="categoria_id" class="form-control" required>
                                    <option value="" selected disabled>Selecciona una categoría</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?php echo $categoria['categoria_id']; ?>">
                                            <?php echo $categoria['nombre_categoria']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                             <!-- Campo Proveedor -->
                             <div class="form-group">
                                <label for="proveedor_id">Proveedor:</label>
                                <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                                    <option value="">Selecciona un proveedor</option>
                                    <?php foreach ($proveedores as $proveedor) { ?>
                                        <option value="<?php echo $proveedor['proveedor_id']; ?>">
                                            <?php echo $proveedor['nombre_proveedor']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                            <!-- Botón para enviar -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Agregar Pedido</button>
                            </div>
                        </div>
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

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
    // Si el pedido fue agregado exitosamente, muestra la alerta y luego redirige
    <?php if ($pedido_agregado): ?>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: 'Pedido agregado exitosamente',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        // Redirige a Management_Orders.php cuando se cierre la alerta
        if (result.isConfirmed) {
            window.location.href = 'Management_Orders.php';
        }
    });
    <?php endif; ?>
</script>
<script>
document.querySelector('form').addEventListener('submit', function(event) {
    const fechaPedido = document.getElementById('fecha_pedido').value;
    const today = new Date();
    const inputDate = new Date(fechaPedido);

    // Comprobar si la fecha del pedido es mayor que la fecha actual
    if (inputDate > today) {
        event.preventDefault(); // Evita que se envíe el formulario
        Swal.fire({
            icon: 'error',
            title: 'Fecha inválida',
            text: 'La fecha del pedido no puede ser mayor que la fecha actual.',
            confirmButtonText: 'Aceptar'
        });
    }
});
</script>


</body>

</html>