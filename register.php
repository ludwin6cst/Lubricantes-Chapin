<?php
session_start();

// Verificar si el parámetro 'ActionType' existe, si no, asignarle un valor por defecto
$ActionType = isset($_GET['ActionType']) ? $_GET['ActionType'] : 'Register';

$EditingUser = false;

if ($ActionType == "Edit") {
    $ID = $_GET['ID']; // El ID del usuario a editar
    $Loc = $_GET['Loc'];
    $EditingUser = true; // Indicar que estamos en modo edición
}

require 'Connection.php';

// Verificar si hay un usuario en sesión
$Username = isset($_SESSION['Username']) ? $_SESSION['Username'] : null;

$errorMessage = isset($_GET['error']) && $_GET['error'] == 'usuario_existente' ? 'Usuario ya registrado' : '';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        <?php echo ($ActionType == "Register") ? "Agregar un nuevo administrador" : "Editar Información de Cuenta"; ?>
    </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> <!-- Asegúrate de que esta línea esté aquí -->
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

        .form-container {
            margin: 0 auto;
            /* Para centrar el formulario horizontalmente */
            padding: 20px;
            /* Ajusta el padding para hacerlo más compacto */
            max-width: 400px;
            /* Define un ancho máximo para centrar y mantener compacto */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Para darle un toque de sombra y profundidad */
            background-color: #f9f9f9;
            /* Color de fondo para destacar */
            border-radius: 8px;
            /* Bordes redondeados */
        }

        .form-group {
            margin-bottom: 20px;
            /* Reduce el margen entre los grupos de formulario */
        }

        .form-group label {
            color: #2c3e50;
            font-size: 14px;
            /* Tamaño de fuente más pequeño */
            font-weight: bold;
            /* Hace el texto un poco más destacado */
        }

        .form-control {
            padding: 8px;
            /* Reduce el padding para hacerlo más compacto */
            font-size: 14px;
            /* Tamaño de texto ligeramente reducido */
            width: 100%;
            /* Hace que el control ocupe el ancho completo */
            border-radius: 4px;
            /* Bordes suavizados */
            border: 1px solid #ccc;
            /* Un borde ligero y limpio */
        }

        .navbar a:hover {
            background-color: #3498db;
        }

        .intro-text {
            color: #2980b9;
            font-weight: bold;
            text-align: center;
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
    <div class="address-bar"><strong>La mejor tienda de lubricantes en cedros</strong></div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Alternar navegación</span>
                    <span class="icon-bar"></s>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Lubricantes Chapin</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-center">
                    <li><a href="Management_Customers.php">Administradores</a></li>

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

    <!-- Estilos adicionales -->
    <style>
        /* Estilo general de la barra de navegación */
        .navbar {
            background-color: #2c3e50;
            /* Azul oscuro */
            border: none;
            border-radius: 0;
            font-size: 15px;
            /* Tamaño de fuente más grande */
            padding: 20px 0;
            /* Más padding para hacer la barra más alta */
        }

        /* Aumenta el tamaño de los enlaces */
        .navbar-nav>li>a {
            color: #2c3e50;
            font-weight: bold;
            font-size: 15px;
            /* Texto más grande */
            padding: 20px;
            justify-content: center;
            /* Aumenta el espacio alrededor de los enlaces */
        }

        /* Estilo cuando pasas el cursor por los enlaces */
        .navbar-nav>li>a:hover {
            background-color: #2c3e50;
            /* Azul más claro */
            color: white;
        }

        /* Menú desplegable en hover */
        #admin-dropdown:hover .dropdown-menu {
            display: block;
            background-color: #2c3e50;
            /* Azul medio */
            border-radius: 0;
        }

        /* Estilo de los elementos del menú desplegable */
        .dropdown-menu>li>a {
            color: #fff;
            padding: 15px 30px;
            /* Aumenta el espacio en los elementos del menú */
            font-size: 10px;
            /* Tamaño de texto del dropdown */
        }

        .dropdown-menu>li>a:hover {
            background-color: #0052a3;
            /* Azul más oscuro */
        }

        /* Centra el contenido del navbar */
        .navbar-nav {
            display: flex;
            justify-content: center;
            /* Centra horizontalmente */
        }

        .image-container {
            text-align: right;
            /* Mover la imagen a la derecha */
            margin-top: 30px;
            /* Ajusta este valor para subir la imagen */
        }

        .image-container img {
            max-width: 100%;
            /* Asegura que la imagen no sobresalga del contenedor */
            height: auto;
            /* Mantiene la proporción de la imagen */
            border-radius: 8px;
            /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra para la imagen */
            float: right;
            /* Mueve la imagen a la derecha */
        }

        .caret {
            border-top: 6px solid white;
        }

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
                    <h2 class="intro-text">
                        <?php echo ($ActionType == "Register") ? "Agregar un nuevo administrador" : "Editar la Información de tu Cuenta"; ?>
                    </h2>
                    <hr>

                    <div class="col-md-6">
                        <form role="form" id="adminForm"
                            action="RegisterAction.php?ActionType=<?php echo $ActionType;
                            if ($ActionType == "Edit") {
                                echo "&Loc=" . $Loc . "&ID=" . $ID;
                            } ?>"
                            method="POST">

                            <div class="form-group">
                                <label for="username">Usuario:</label>
                                <input type="text" name="Username" class="form-control" id="Username"
                                    placeholder="Ingresa tu usuario" required
                                    value="<?php echo isset($EditUsername) ? $EditUsername : ''; ?>">
                                    <span style="color:red;"><?php echo $errorMessage; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="Password">Contraseña:</label>
                                <input type="password" name="Password" class="form-control" id="Password"
                                    placeholder="Ingresa tu contraseña" required>
                            </div>

                            <div class="form-group">
                                <label for="Firstname">Primer Nombre:</label>
                                <input type="text" name="Firstname" class="form-control" id="Firstname"
                                    placeholder="Ingresa tu primer nombre" required
                                    value="<?php echo isset($EditFirstname) ? $EditFirstname : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="Middlename">Primer Apellido:</label>
                                <input type="text" name="Middlename" class="form-control" id="Middlename"
                                    placeholder="Ingresa tu primer apellido" required
                                    value="<?php echo isset($EditMiddlename) ? $EditMiddlename : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="Lastname">Segundo Apellido:</label>
                                <input type="text" name="Lastname" class="form-control" id="Lastname"
                                    placeholder="Ingresa tu segundo apellido" required
                                    value="<?php echo isset($EditLastname) ? $EditLastname : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="Address">Dirección:</label>
                                <input type="text" name="Address" class="form-control" id="Address"
                                    placeholder="Ingresa tu dirección" required
                                    value="<?php echo isset($EditAddress) ? $EditAddress : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="EmailAddress">Dirección de Correo:</label>
                                <input type="email" name="EmailAddress" class="form-control" id="EmailAddress"
                                    placeholder="Ingresa tu dirección de correo" required
                                    value="<?php echo isset($EditEmailAddress) ? $EditEmailAddress : ''; ?>">
                            </div>

                            <button type="button" class="btn btn-default" id="addAdminButton">Agregar</button><br><br>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="image-container">
                            <img src="uploads/gerente.png" class="img-responsive" alt="Imagen decorativa">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const addButton = document.getElementById('addAdminButton');
        const adminForm = document.getElementById('adminForm');

        // Obtener parámetros de la URL
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');
        const error = urlParams.get('error');

        // Mostrar mensaje de error si el usuario ya existe
        if (error === 'usuario_existente') {
            Swal.fire({
                title: 'Error',
                text: 'El nombre de usuario ya está registrado.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                // Redirigir a register.php después de cerrar la alerta
                window.location.href = "register.php";
            });
        }

        // Mostrar mensaje de éxito si el registro fue exitoso
        if (success) {
            Swal.fire({
                title: '¡Éxito!',
                text: 'Administrador registrado correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                // Redirigir después de un breve retraso
                setTimeout(() => {
                    window.location.href = "Management_Customers.php"; // Ajusta la URL según lo necesario
                }, 1000); // Retraso de 2 segundos (2000 ms)
            });
        }

        addButton.addEventListener('click', function(event) {
            event.preventDefault();

            // Si el registro es exitoso, envía el formulario
            adminForm.submit();
        });
    });
</script>






</body>

</html>