<?php
session_start();
require 'Connection.php';

if (!isset($_GET['EditID'])) {
    echo '<script>window.open("Management_Customers.php","_self",null,true);</script>';
    exit();
}

$CustomerID = $_GET['EditID'];

// Obtener los detalles del administrador actual
$sql = "SELECT * FROM administradores WHERE CustomerID = $CustomerID";
$result = mysqli_query($Conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo '<script>window.open("Management_Customers.php","_self",null,true);</script>';
    exit();
}

// Si se envía el formulario, redirigir a Management_Customers_Action.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<script>window.open("Management_Customers_Action.php?EditID=' . $CustomerID . '","_self",null,true);</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Administrador - Lubricantes Chapin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <!-- Formulario de edición de administrador -->
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Detalles del Administrador</h2>
                    <hr>

                    <form method="POST" action="Management_Customers_Action.php">
                        <!-- Campo oculto para CustomerID -->
                        <input type="hidden" name="CustomerID" value="<?php echo $CustomerID; ?>">
                        <!-- Campo oculto para la acción -->
                        <input type="hidden" name="action" value="edit">

                        <div class="form-group">
                            <label for="Username">Usuario:</label>
                            <input type="text" name="Username" class="form-control"
                                value="<?php echo htmlspecialchars($row['Username']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Password">Contraseña:</label>
                            <input type="password" name="Password" class="form-control" value=""
                                placeholder="Ingrese una nueva contraseña o ingrese su contraseña actual" required>
                        </div>
                        <div class="form-group">
                            <label for="Firstname">Primer Nombre:</label>
                            <input type="text" name="Firstname" class="form-control"
                                value="<?php echo htmlspecialchars($row['Firstname']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Middlename">Segundo Nombre:</label>
                            <input type="text" name="Middlename" class="form-control"
                                value="<?php echo htmlspecialchars($row['Middlename']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Lastname">Apellido:</label>
                            <input type="text" name="Lastname" class="form-control"
                                value="<?php echo htmlspecialchars($row['Lastname']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Address">Dirección:</label>
                            <input type="text" name="Address" class="form-control"
                                value="<?php echo htmlspecialchars($row['Address']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="EmailAddress">Correo Electrónico:</label>
                            <input type="email" name="EmailAddress" class="form-control"
                                value="<?php echo htmlspecialchars($row['EmailAddress']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="Management_Customers.php" class="btn btn-secondary">Cancelar</a>
                    </form>
                    <script>
    <?php if (isset($_SESSION['message'])): ?>
        Swal.fire({
            title: 'Éxito',
            text: '<?php echo $_SESSION['message']; ?>',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</script>

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

    <!-- Incluye Bootstrap JS y jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        <?php if (isset($_SESSION['message'])): ?>
            Swal.fire({
                title: 'Éxito',
                text: '<?php echo $_SESSION['message']; ?>',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            <?php unset($_SESSION['message']); // Limpia el mensaje después de mostrarlo ?>
        <?php endif; ?>
    });
</script>

</body>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        <?php if (isset($_SESSION['message'])): ?>
            Swal.fire({
                title: 'Éxito',
                text: '<?php echo $_SESSION['message']; ?>',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            <?php unset($_SESSION['message']); // Limpia el mensaje después de mostrarlo ?>
        <?php endif; ?>
    });
</script>


</html>